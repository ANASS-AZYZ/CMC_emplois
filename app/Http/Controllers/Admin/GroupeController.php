<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Groupe;
use App\Models\Filiere;
use Illuminate\Http\Request;

class GroupeController extends Controller
{
    /**
     * Afficher la liste des groupes avec leurs filières.
     */
    public function index()
    {
        // On récupère les groupes avec la relation filiere 
        $groupes = Groupe::with('filiere')->get();
        return view('admin.groupes.index', compact('groupes'));
    }

    /**
     * Afficher le formulaire de création de groupe.
     */
    public function create()
    {
        // Récupérer toutes les filières pour le select [cite: 107]
        $filieres = Filiere::all();
        return view('admin.groupes.create', compact('filieres'));
    }

    /**
     * Enregistrer un nouveau groupe.
     */
    public function store(Request $request)
    {
        // Validation selon le cahier des charges [cite: 55, 57]
        $validated = $request->validate([
            'code'       => 'required|unique:groupes,code|max:50', // Code unique ex: DEVOWFS201 [cite: 55]
            'filiere_id' => 'required|exists:filieres,id',        // Doit appartenir à une filière 
            'annee'      => 'required|in:1,2'                     // 1ère ou 2ème année 
        ]);

        Groupe::create($validated);

        return redirect()->route('groupes.index')->with('success', 'Groupe créé avec succès !');
    }

    /**
     * Afficher le formulaire d'édition.
     */
    public function edit(Groupe $groupe)
    {
        $filieres = Filiere::all();
        return view('admin.groupes.edit', compact('groupe', 'filieres'));
    }

    /**
     * Mettre à jour les informations du groupe.
     */
    public function update(Request $request, Groupe $groupe)
    {
        // Validation avec exception de l'ID actuel pour l'unique [cite: 55]
        $validated = $request->validate([
            'code'       => 'required|max:50|unique:groupes,code,' . $groupe->id,
            'filiere_id' => 'required|exists:filieres,id',
            'annee'      => 'required|in:1,2'
        ]);

        $groupe->update($validated);

        return redirect()->route('groupes.index')->with('success', 'Groupe mis à jour avec succès !');
    }

    /**
     * Supprimer un groupe.
     */
    public function destroy(Groupe $groupe)
    {
        // T-akked beli l-groupe ma-3ndouch des séances liées qbel l-hadf (Optionnel)
        if ($groupe->seances()->exists()) {
            return back()->with('error', 'Impossible de supprimer ce groupe car il a des séances planifiées.');
        }

        $groupe->delete();

        return redirect()->route('groupes.index')->with('success', 'Groupe supprimé définitivement.');
    }
}