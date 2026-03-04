<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Salle;
use Illuminate\Http\Request;

class SalleController extends Controller
{
    /**
     * Afficher la liste de toutes les salles (SC et SM).
     */
    public function index()
    {
        $salles = Salle::all();
        return view('admin.salles.index', compact('salles'));
    }

    /**
     * Afficher le formulaire de création d'une salle.
     */
    public function create()
    {
        return view('admin.salles.create');
    }

    /**
     * Enregistrer une nouvelle salle dans la base de données.
     */
    public function store(Request $request)
    {
        // Validation selon les contraintes : code unique et type spécifique
        $validated = $request->validate([
            'code'     => 'required|unique:salles,code|max:20', // ex: SC-01
            'type'     => 'required|in:SC,SM',                // SC: Cours, SM: Multimédia
            'capacite' => 'nullable|integer|min:1',           // Optionnel selon le cahier des charges
        ]);

        Salle::create($validated);

        return redirect()->route('salles.index')->with('success', 'La salle a été ajoutée avec succès !');
    }

    /**
     * Afficher le formulaire d'édition pour une salle spécifique.
     */
    public function edit(Salle $salle)
    {
        // Utilisation correcte de compact('salle') pour la vue
        return view('admin.salles.edit', compact('salle'));
    }

    /**
     * Mettre à jour les informations de la salle.
     */
    public function update(Request $request, Salle $salle)
    {
        // Validation avec exception de l'ID actuel pour l'unique code
        $validated = $request->validate([
            'code'     => 'required|max:20|unique:salles,code,' . $salle->id,
            'type'     => 'required|in:SC,SM',
            'capacite' => 'nullable|integer|min:1',
        ]);

        $salle->update($validated);

        return redirect()->route('salles.index')->with('success', 'Les informations de la salle ont été modifiées !');
    }

    /**
     * Supprimer une salle de l'application.
     */
    public function destroy(Salle $salle)
    {
        // Vérification si la salle est utilisée dans des séances planifiées
        if ($salle->seances()->exists()) {
            return back()->with('error', 'Impossible de supprimer cette salle car elle est actuellement occupée dans l\'emploi du temps.');
        }

        $salle->delete();

        return redirect()->route('salles.index')->with('success', 'La salle a été supprimée définitivement.');
    }
}