<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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

        $incomingName = trim((string) $request->input('name', ''));
        $incomingEmail = mb_strtolower(trim((string) $request->input('email', '')));

        if ($user->role === 'formateur') {
            $currentName = trim((string) $user->name);
            $currentEmail = mb_strtolower(trim((string) $user->email));

            if ($incomingName !== $currentName || $incomingEmail !== $currentEmail) {
                return Redirect::route('profile.edit')->withErrors([
                    'profile' => 'Modification du nom et de l\'email non autorisee pour les formateurs.',
                ]);
            }
        } else {
            $user->fill($request->safe()->only(['name', 'email']));
        }

        if ($request->boolean('remove_avatar') && $user->avatar) {
            Storage::disk('public')->delete($user->avatar);
            $user->avatar = null;
        }

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

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

    public function updatePassword(Request $request)
    {
        $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = $request->user();
        $user->password = bcrypt($request->new_password);
        $user->save();

        return redirect()->back()->with('status', 'password-updated');
    }
}
