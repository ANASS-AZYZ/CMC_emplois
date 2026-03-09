<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ProfileController extends Controller
{
    
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->role === 'admin') {
            return Redirect::route('profile.edit')->withErrors([
                'profile' => 'Modification des informations du profil non autorisee pour les administrateurs.',
            ]);
        }

        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
        DB::transaction(function () use ($user, $request) {
            $user->save();
            if ($user->role === 'formateur' && $user->formateur) {
                $nameParts = explode(' ', $user->name, 2);
                $prenom = $nameParts[0] ?? '';
                $nom = $nameParts[1] ?? '';

                $user->formateur->update([
                    'nom' => $nom ?: $user->name,
                    'prenom' => $prenom,
                    'email_professionnel' => $user->email,
                ]);
            }
        });

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    
    public function destroy(Request $request): RedirectResponse
    {
        if ($request->user()->role === 'formateur') {
            abort(403, 'Suppression du compte non autorisee pour les formateurs.');
        }

        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();
        DB::transaction(function () use ($user) {
            if ($user->role === 'formateur' && $user->formateur) {
                $user->formateur->delete();
            }
            $user->delete();
        });

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
