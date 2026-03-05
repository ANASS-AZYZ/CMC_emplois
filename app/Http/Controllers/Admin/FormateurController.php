<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Formateur;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class FormateurController extends Controller
{
    
    public function index()
    {
        $formateurs = Formateur::with('user')->get();
        return view('admin.formateurs.index', compact('formateurs'));
    }

    
    public function create()
    {
        return view('admin.formateurs.create');
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'matricule'           => 'required|unique:formateurs,matricule',
            'nom'                 => 'required|string|max:255',
            'prenom'              => 'required|string|max:255',
            'email_professionnel' => 'required|email|unique:users,email|unique:formateurs,email_professionnel',
            'telephone'           => 'required|string|max:20',
            'specialite'          => 'required|string|max:255',
            'password'            => 'required|min:8|confirmed',
        ], [
            'matricule.required' => 'Le matricule est obligatoire.',
            'matricule.unique' => 'Ce matricule existe deja.',
            'nom.required' => 'Le nom est obligatoire.',
            'prenom.required' => 'Le prenom est obligatoire.',
            'email_professionnel.required' => "L'email professionnel est obligatoire.",
            'email_professionnel.email' => "L'email professionnel est invalide.",
            'email_professionnel.unique' => "Cet email professionnel est deja utilise.",
            'telephone.required' => 'Le telephone est obligatoire.',
            'specialite.required' => 'La specialite est obligatoire.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caracteres.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
        ]);

        DB::transaction(function () use ($validated) {
            $user = User::create([
                'name'     => $validated['prenom'] . ' ' . $validated['nom'],
                'email'    => $validated['email_professionnel'],
                'password' => Hash::make($validated['password']),
                'role'     => 'formateur',
            ]);

            Formateur::create([
                'matricule'           => $validated['matricule'],
                'nom'                 => $validated['nom'],
                'prenom'              => $validated['prenom'],
                'email_professionnel' => $validated['email_professionnel'],
                'telephone'           => $validated['telephone'],
                'specialite'          => $validated['specialite'],
                'user_id'             => $user->id,
            ]);
        });

        return redirect()->route('formateurs.index')->with('success', 'Formateur et compte de connexion créés avec succès !');
    }

    
    public function edit(Formateur $formateur)
    {
        return view('admin.formateurs.edit', compact('formateur'));
    }

    
    public function update(Request $request, Formateur $formateur)
    {
        $userId = $formateur->user?->id;

        $validated = $request->validate([
            'matricule'           => 'required|unique:formateurs,matricule,' . $formateur->id,
            'nom'                 => 'required|string|max:255', 
            'prenom'              => 'required|string|max:255',
            'email_professionnel' => [
                'required',
                'email',
                Rule::unique('formateurs', 'email_professionnel')->ignore($formateur->id),
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'telephone'           => 'required|string|max:20',
            'specialite'          => 'required|string|max:255',
            'password'            => 'nullable|string|min:8',
        ], [
            'matricule.required' => 'Le matricule est obligatoire.',
            'matricule.unique' => 'Ce matricule existe deja.',
            'nom.required' => 'Le nom est obligatoire.',
            'prenom.required' => 'Le prenom est obligatoire.',
            'email_professionnel.required' => "L'email professionnel est obligatoire.",
            'email_professionnel.email' => "L'email professionnel est invalide.",
            'email_professionnel.unique' => "Cet email professionnel est deja utilise.",
            'telephone.required' => 'Le telephone est obligatoire.',
            'specialite.required' => 'La specialite est obligatoire.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caracteres.',
        ]);

        DB::transaction(function () use ($validated, $formateur) {
            $formateur->update($validated);

            if($formateur->user) {
                $userData = [
                    'name'  => $validated['prenom'] . ' ' . $validated['nom'],
                    'email' => $validated['email_professionnel'],
                ];

                if (! empty($validated['password'])) {
                    $userData['password'] = Hash::make($validated['password']);
                }

                $formateur->user->update($userData);
            }
        });

        return redirect()->route('formateurs.index')->with('success', 'Informations du formateur mises à jour avec succès !');
    }

    
    public function destroy(Formateur $formateur)
    {
        DB::transaction(function () use ($formateur) {
            if ($formateur->user) {
                $formateur->user->delete();
            }
            $formateur->delete();
        });

        return redirect()->route('formateurs.index')->with('success', 'Le formateur et son compte ont été supprimés définitivement.');
    }
}
