<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Groupe;
use App\Models\Filiere;
use Illuminate\Http\Request;

class GroupeController extends Controller
{
    
    public function index()
    {
        $groupes = Groupe::with('filiere')->get();
        return view('admin.groupes.index', compact('groupes'));
    }

    
    public function create()
    {
        $filieres = Filiere::all();
        return view('admin.groupes.create', compact('filieres'));
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code'       => 'required|unique:groupes,code|max:50', // Code unique ex: DEVOWFS201 [cite: 55]
            'filiere_id' => 'required|exists:filieres,id',        // Doit appartenir à une filière 
            'annee'      => 'required|in:1,2,1ère,2ème'           // 1ère ou 2ème année 
        ]);

        $validated['annee'] = in_array((string) $validated['annee'], ['1', '1ère'], true) ? '1ère' : '2ème';

        Groupe::create($validated);

        return redirect()->route('groupes.index')->with('success', 'Groupe créé avec succès !');
    }

    
    public function edit(Groupe $groupe)
    {
        $filieres = Filiere::all();
        return view('admin.groupes.edit', compact('groupe', 'filieres'));
    }

    
    public function update(Request $request, Groupe $groupe)
    {
        $validated = $request->validate([
            'code'       => 'required|max:50|unique:groupes,code,' . $groupe->id,
            'filiere_id' => 'required|exists:filieres,id',
            'annee'      => 'required|in:1,2,1ère,2ème'
        ]);

        $validated['annee'] = in_array((string) $validated['annee'], ['1', '1ère'], true) ? '1ère' : '2ème';

        $groupe->update($validated);

        return redirect()->route('groupes.index')->with('success', 'Groupe mis à jour avec succès !');
    }

    
    public function destroy(Groupe $groupe)
    {
        if ($groupe->seances()->exists()) {
            return back()->with('error', 'Impossible de supprimer ce groupe car il a des séances planifiées.');
        }

        $groupe->delete();

        return redirect()->route('groupes.index')->with('success', 'Groupe supprimé définitivement.');
    }
}
