<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Throwable;

class PasswordResetLinkController extends Controller
{
    
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ], [
            'email.exists' => 'Cet email est introuvable.',
        ]);

        $email = Str::lower(trim($validated['email']));
        $otp = (string) random_int(100000, 999999);

        Cache::put($this->otpCacheKey($email), [
            'otp_hash' => Hash::make($otp),
            'issued_at' => now()->timestamp,
        ], now()->addMinutes(10));

        try {
            Mail::raw("Votre code OTP de reinitialisation est : {$otp}. Il est valide pendant 10 minutes.", function ($message) use ($email) {
                $message->to($email)
                    ->subject('Code OTP - Reinitialisation du mot de passe');
            });
        } catch (Throwable $e) {
            Cache::forget($this->otpCacheKey($email));

            return back()
                ->withInput(['email' => $email])
                ->withErrors(['email' => 'Impossible d\'envoyer le code OTP pour le moment.']);
        }

        return back()
            ->with('status', 'Un code OTP a ete envoye a votre adresse email.')
            ->with('otp_sent', true)
            ->withInput(['email' => $email]);
    }

    public function verifyOtp(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'otp' => ['required', 'digits:6'],
        ], [
            'email.exists' => 'Cet email est introuvable.',
            'otp.required' => 'Le code OTP est obligatoire.',
            'otp.digits' => 'Le code OTP doit contenir 6 chiffres.',
        ]);

        $email = Str::lower(trim($validated['email']));
        $cacheData = Cache::get($this->otpCacheKey($email));

        if (!$cacheData || !isset($cacheData['otp_hash']) || !Hash::check($validated['otp'], $cacheData['otp_hash'])) {
            return back()
                ->withInput(['email' => $email])
                ->with('otp_sent', true)
                ->withErrors(['otp' => 'Code OTP invalide ou expire.']);
        }

        $request->session()->put('password_reset_otp_verified_email', $email);
        $request->session()->put('password_reset_otp_verified_at', now()->timestamp);

        Cache::forget($this->otpCacheKey($email));

        return redirect()->route('password.otp.reset.form');
    }

    public function showResetForm(Request $request): View|RedirectResponse
    {
        $email = (string) $request->session()->get('password_reset_otp_verified_email', '');
        $verifiedAt = (int) $request->session()->get('password_reset_otp_verified_at', 0);

        if (!$email || !$verifiedAt || now()->timestamp - $verifiedAt > 600) {
            $request->session()->forget(['password_reset_otp_verified_email', 'password_reset_otp_verified_at']);

            return redirect()->route('password.request')->withErrors([
                'otp' => 'Session OTP expiree. Veuillez recommencer.',
            ]);
        }

        return view('auth.reset-password-otp', [
            'email' => $email,
        ]);
    }

    public function resetPassword(Request $request): RedirectResponse
    {
        $sessionEmail = (string) $request->session()->get('password_reset_otp_verified_email', '');
        $verifiedAt = (int) $request->session()->get('password_reset_otp_verified_at', 0);

        if (!$sessionEmail || !$verifiedAt || now()->timestamp - $verifiedAt > 600) {
            $request->session()->forget(['password_reset_otp_verified_email', 'password_reset_otp_verified_at']);

            return redirect()->route('password.request')->withErrors([
                'otp' => 'Session OTP expiree. Veuillez recommencer.',
            ]);
        }

        $validated = $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::where('email', $sessionEmail)->first();
        if (!$user) {
            $request->session()->forget(['password_reset_otp_verified_email', 'password_reset_otp_verified_at']);

            return redirect()->route('password.request')->withErrors([
                'email' => 'Cet email est introuvable.',
            ]);
        }

        $user->forceFill([
            'password' => Hash::make($validated['password']),
            'remember_token' => Str::random(60),
        ])->save();

        $request->session()->forget(['password_reset_otp_verified_email', 'password_reset_otp_verified_at']);

        return redirect()->route('login')->with('status', 'Mot de passe mis a jour avec succes.');
    }

    private function otpCacheKey(string $email): string
    {
        return 'password_reset_otp:' . $email;
    }
}

