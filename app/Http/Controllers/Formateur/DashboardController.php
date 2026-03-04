<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use App\Models\Seance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * [ESPACE FORMATEUR] Affichage de l'emploi du temps personnel.
     * URL: http://127.0.0.1:8000/formateur
     */
    public function index()
    {
        // 1. Récupération de l'utilisateur connecté
        $user = Auth::user();
        
        // 2. Récupération du profil formateur lié [cite: 122]
        // Note: Khass l-relation 'formateur' t-koun f Model User
        $formateur = $user->formateur; 

        if (!$formateur) {
            return "Erreur : Votre compte n'est pas lié à un formateur. Utilisez Tinker.";
        }

        // 3. Définition des constantes de la grille (OFPPT Standard) [cite: 75, 77]
        $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
        $creneaux = ['S1', 'S2', 'S3', 'S4']; // 08:30 -> 18:30 

        // 4. Récupération des séances du formateur avec les détails [cite: 125]
        $seances = Seance::with(['groupe', 'salle'])
            ->where('formateur_id', $formateur->id)
            ->get();

        // 5. Organisation de la data pour la grille Blade [cite: 160]
        $emploi = [];
        foreach ($seances as $s) {
            $emploi[$s->jour][$s->creneau] = $s;
        }

        // 6. Envoi des données à la vue (Espace Formateur) [cite: 155]
        return view('formateur.dashboard', compact('emploi', 'jours', 'creneaux', 'formateur'));
    }
}