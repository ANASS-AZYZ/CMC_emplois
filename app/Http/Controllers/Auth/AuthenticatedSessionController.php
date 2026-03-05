<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    
    public function create(): View
    {
        return view('auth.login');
    }

    
    public function store(LoginRequest $request): RedirectResponse
    {
        $requestedRole = $request->input('login_as');
        $request->authenticate();
        $request->session()->regenerate();
        $user = Auth::user();
        $isCanonicalAdmin = $user->role === 'admin' && $user->email === 'admin@cmc.ma';
        if ($user->role === 'admin' && ! $isCanonicalAdmin) {
            $user->update(['role' => 'formateur']);
            $user->refresh();
        }
        if ($requestedRole === 'admin' && ! $isCanonicalAdmin) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->withErrors([
                'email' => 'Informations de connexion incorrectes.',
            ])->onlyInput('email');
        }

        if (in_array($requestedRole, ['admin', 'formateur'], true) && $user->role !== $requestedRole) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->withErrors([
                'email' => 'Informations de connexion incorrectes.',
            ])->onlyInput('email');
        }
        if ($isCanonicalAdmin) {
            return redirect()->intended(route('dashboard'));
        }

        if ($user->role === 'formateur') {
            return redirect()->intended(route('formateur.dashboard'));
        }
        return redirect()->intended(route('dashboard', absolute: false));
    }

    
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
