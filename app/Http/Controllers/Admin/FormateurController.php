<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Formateur;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class FormateurController extends Controller
{
    /**
     * Afficher la liste des formateurs avec leurs comptes User liés.
     */
    public function index()
    {
        // On récupère les formateurs avec la relation 'user'
        $formateurs = Formateur::with('user')->get();
        return view('admin.formateurs.index', compact('formateurs'));
    }

    /**
     * Afficher le formulaire de création.
     */
    public function create()
    {
        return view('admin.formateurs.create');
    }

    /**
     * Enregistrer un nouveau formateur et créer son compte de connexion automatique.
     */
    public function store(Request $request)
    {
        // Validation dqiqa m3a l-contraintes dial cahier des charges
        $validated = $request->validate([
            'matricule'           => 'required|unique:formateurs,matricule',
            'nom'                 => 'required|string|max:255',
            'prenom'              => 'required|string|max:255',
            'email_professionnel' => 'required|email|unique:users,email|unique:formateurs,email_professionnel',
            'telephone'           => 'required|string|max:20',
            'specialite'          => 'required|string|max:255',
            'password'            => 'required|min:8|confirmed', // Admin définit le mot de passe initial
        ]);

        // Transaction bach may-t-creey walou ila tra moshkil f l-base
        DB::transaction(function () use ($validated) {
            
            // 1. Création du compte User (Table users) pour le Login
            $user = User::create([
                'name'     => $validated['prenom'] . ' ' . $validated['nom'],
                'email'    => $validated['email_professionnel'],
                'password' => Hash::make($validated['password']),
                'role'     => 'formateur', // Role fixe pour redirection vers espace formateur
            ]);

            // 2. Création du profil Formateur lié à l'User
            Formateur::create([
                'matricule'           => $validated['matricule'],
                'nom'                 => $validated['nom'],
                'prenom'              => $validated['prenom'],
                'email_professionnel' => $validated['email_professionnel'],
                'telephone'           => $validated['telephone'],
                'specialite'          => $validated['specialite'],
                'user_id'             => $user->id, // Liaison cruciale pour le Dashboard
            ]);
        });

        return redirect()->route('formateurs.index')->with('success', 'Formateur et compte de connexion créés avec succès !');
    }

    /**
     * Afficher le formulaire d'édition.
     */
    public function edit(Formateur $formateur)
    {
        return view('admin.formateurs.edit', compact('formateur'));
    }

    /**
     * Mettre à jour les informations du formateur et de son compte.
     */
    public function update(Request $request, Formateur $formateur)
    {
        $validated = $request->validate([
            'matricule'           => 'required|unique:formateurs,matricule,' . $formateur->id,
            'nom'                 => 'required|string|max:255', 
            'prenom'              => 'required|string|max:255',
            'email_professionnel' => 'required|email|unique:formateurs,email_professionnel,' . $formateur->id,
            'telephone'           => 'required|string|max:20',
            'specialite'          => 'required|string|max:255',
        ]);

        DB::transaction(function () use ($validated, $formateur) {
            // Update l-profil formateur
            $formateur->update($validated);
            
            // Sync l-email et name f l-table users pour le login
            if($formateur->user) {
                $formateur->user->update([
                    'name'  => $validated['prenom'] . ' ' . $validated['nom'],
                    'email' => $validated['email_professionnel'],
                ]);
            }
        });

        return redirect()->route('formateurs.index')->with('success', 'Informations du formateur mises à jour avec succès !');
    }

    /**
     * Supprimer un formateur et son compte User associé.
     */
    public function destroy(Formateur $formateur)
    {
        DB::transaction(function () use ($formateur) {
            // On supprime d'abord le compte utilisateur pour respecter l'intégrité
            if ($formateur->user) {
                $formateur->user->delete();
            }
            $formateur->delete();
        });

        return redirect()->route('formateurs.index')->with('success', 'Le formateur et son compte ont été supprimés définitivement.');
    }
}