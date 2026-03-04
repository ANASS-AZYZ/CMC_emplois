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
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     * Logic t-zad bach i-sync l-data m3a table formateurs.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Transaction bach n-dmnu l-cohérence dial l-data
        DB::transaction(function () use ($user, $request) {
            $user->save();

            // Ila kan l-user formateur, n-update-o l-profil dyalo hta hwa
            if ($user->role === 'formateur' && $user->formateur) {
                // Kan-ferrqo l-name l-Nom o Prenom (optional logic)
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

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        // Transaction bach n-ms7o l-user o l-formateur lié f merra
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