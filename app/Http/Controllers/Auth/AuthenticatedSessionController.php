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
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // 1. Authentification dyal l-credentials (email/password) 
        $request->authenticate();

        // 2. Regeneration dyal session bach n-mne3ou session fixation 
        $request->session()->regenerate();

        // 3. Récupération dyal l-utilisateur li dkhul
        $user = Auth::user();

        // 4. Redirection selon le rôle (Admin ou Formateur) 
        if ($user->role === 'admin') {
            // L-Admin imchi l l-URL dial l-Dashboard principal [cite: 103, 140]
            return redirect()->intended(route('dashboard'));
        }

        if ($user->role === 'formateur') {
            // L-Formateur imchi l l-URL dial l-Espace Formateur [cite: 119, 154]
            return redirect()->intended(route('formateur.dashboard'));
        }

        // Par défaut (Stagiaire ou autre), redirect l l-accueil [cite: 162]
        return redirect()->intended('/');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}