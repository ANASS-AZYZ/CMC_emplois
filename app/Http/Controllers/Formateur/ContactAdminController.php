<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use App\Models\FormateurMessage;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Throwable;

class ContactAdminController extends Controller
{
    public function create(): View
    {
        $user = Auth::user();
        $fromEmail = optional($user->formateur)->email_professionnel ?: $user->email;

        return view('formateur.contact-admin', [
            'fromEmail' => $fromEmail,
            'fromName' => $user->name,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email_professionnel' => 'required|email',
            'subject' => 'required|string|max:150',
            'message' => 'required|string|max:5000',
        ]);

        $sender = Auth::user();
        $adminEmail = User::query()->where('role', 'admin')->value('email')
            ?: config('mail.from.address', 'admin@cmc.ma');

        FormateurMessage::create([
            'sender_user_id' => $sender->id,
            'email_professionnel' => $validated['email_professionnel'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
        ]);

        $body = "Message recu depuis le portail formateur CMC\n\n"
            . "Expediteur: {$sender->name}\n"
            . "Email professionnel: {$validated['email_professionnel']}\n"
            . "Date: " . now()->format('Y-m-d H:i') . "\n\n"
            . "Contenu:\n{$validated['message']}\n";

        try {
            Mail::raw($body, function ($mail) use ($adminEmail, $validated) {
                $mail->to($adminEmail)
                    ->subject('[CMC] ' . $validated['subject']);
            });
        } catch (Throwable $e) {
            return back()->withInput()->withErrors([
                'message' => "L'envoi de l'email a echoue. Verifiez la configuration SMTP.",
            ]);
        }

        return redirect()->route('formateur.contact-admin.create')
            ->with('success', "Message envoye a l'admin avec succes.");
    }
}
