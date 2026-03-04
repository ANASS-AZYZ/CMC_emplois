<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seance;
use App\Models\Groupe;
use App\Models\Salle;
use App\Models\Formateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeanceController extends Controller
{
    /**
     * [ADMIN] Liste de toutes les séances planifiées.
     */
    public function index()
    {
        // Gher l-admin li 3ndu l-7eq i-chouf l-listes kamlin
        $seances = Seance::with(['groupe', 'salle', 'formateur'])->get();
        return view('admin.seances.index', compact('seances'));
    }

    /**
     * [ADMIN] Formulaire pour planifier une nouvelle séance.
     */
    public function create()
    {
        $groupes = Groupe::all();
        $salles = Salle::all();
        $formateurs = Formateur::all();
        $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi']; // L-emploi 3la 6 jours
        $creneaux = ['S1', 'S2', 'S3', 'S4']; // 4 séances fixes par jour

        return view('admin.seances.create', compact('groupes', 'salles', 'formateurs', 'jours', 'creneaux'));
    }

    /**
     * [ADMIN] Enregistrement d'une séance avec contrôle strict des conflits.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'groupe_id' => 'required|exists:groupes,id',
            'formateur_id' => 'required|exists:formateurs,id',
            'salle_id' => 'required|exists:salles,id',
            'jour' => 'required|string',
            'creneau' => 'required|string',
        ]);

        // Contrôle des conflits (Groupe, Formateur, Salle)
        $conflit = Seance::where('jour', $request->jour)
            ->where('creneau', $request->creneau)
            ->where(function($q) use ($request) {
                $q->where('groupe_id', $request->groupe_id) // Conflit Groupe
                  ->orWhere('formateur_id', $request->formateur_id) // Conflit Formateur
                  ->orWhere('salle_id', $request->salle_id); // Conflit Salle
            })->exists();

        if ($conflit) {
            return back()->withErrors(['conflit' => 'Conflit détecté ! Ce créneau est déjà occupé.'])->withInput();
        }

        Seance::create($validated);
        return redirect()->route('seances.index')->with('success', 'Séance ajoutée avec succès !');
    }

    /**
     * [ADMIN] Formulaire d'édition d'une séance.
     */
    public function edit(Seance $seance)
    {
        $groupes = Groupe::all();
        $salles = Salle::all();
        $formateurs = Formateur::all();
        $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
        $creneaux = ['S1', 'S2', 'S3', 'S4'];
        
        return view('admin.seances.edit', compact('seance', 'groupes', 'salles', 'formateurs', 'jours', 'creneaux'));
    }

    /**
     * [ADMIN] Mise à jour d'une séance.
     */
    public function update(Request $request, Seance $seance)
    {
        $validated = $request->validate([
            'groupe_id' => 'required|exists:groupes,id',
            'formateur_id' => 'required|exists:formateurs,id',
            'salle_id' => 'required|exists:salles,id',
            'jour' => 'required|string',
            'creneau' => 'required|string',
        ]);

        $seance->update($validated);
        return redirect()->route('seances.index')->with('success', 'Séance modifiée avec succès !');
    }

    /**
     * [ADMIN] Suppression d'une séance planifiée.
     */
    public function destroy(Seance $seance)
    {
        $seance->delete();
        return redirect()->route('seances.index')->with('success', 'Séance annulée !');
    }

    /**
     * [MULTI-ROLE] Consultation de l'emploi du temps (Grille).
     * Accessible par : Admin, Formateur, et Stagiaire.
     */
    public function showEmploi(Request $request)
    {
        $groupes = Groupe::all();
        $selectedGroupe = $request->input('groupe_id');
        $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
        $creneaux = ['S1', 'S2', 'S3', 'S4'];

        $emploi = [];

        // 1. Consultation d'un emploi du temps Groupe (Stagiaire/Filtre)
        if ($selectedGroupe) {
            $seances = Seance::with(['formateur', 'salle', 'groupe'])
                ->where('groupe_id', $selectedGroupe)
                ->get();
                
            foreach ($seances as $seance) {
                $emploi[$seance->jour][$seance->creneau] = $seance;
            }
        }

        // 2. Redirection et Logic spécifique par Role
        if (Auth::check()) {
            $user = Auth::user();

            // Si le formateur n'a pas filtré, on affiche son emploi personnel
            if ($user->role === 'formateur' && !$selectedGroupe) {
                $formateur = $user->formateur; // Relation Model User -> Formateur
                if ($formateur) {
                    $seancesPerso = Seance::with(['groupe', 'salle'])
                        ->where('formateur_id', $formateur->id)
                        ->get();
                    foreach ($seancesPerso as $s) {
                        $emploi[$s->jour][$s->creneau] = $s;
                    }
                }
            }

            // View pour Espace Privé (Admin/Formateur)
            return view('admin.seances.emploi', compact('groupes', 'selectedGroupe', 'jours', 'creneaux', 'emploi'));
        }

        // View Stagiaire (Public)
        return view('stagiaire.emploi', compact('groupes', 'selectedGroupe', 'jours', 'creneaux', 'emploi'));
    }
}