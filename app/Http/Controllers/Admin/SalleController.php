<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Salle;
use Illuminate\Http\Request;

class SalleController extends Controller
{
    
    public function index()
    {
        $salles = Salle::all();
        return view('admin.salles.index', compact('salles'));
    }

    
    public function create()
    {
        return view('admin.salles.create');
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code'     => [
                'required',
                'unique:salles,code',
                'max:20',
                'regex:/^(SC|SM)-[A-Za-z0-9]+$/',
                function ($attribute, $value, $fail) use ($request) {
                    $type = $request->input('type');
                    if ($type && !str_starts_with($value, $type . '-')) {
                        $fail('Le code doit commencer par ' . $type . '- selon le type de salle choisi.');
                    }
                },
            ], // ex: SC-01
            'type'     => 'required|in:SC,SM',                // SC: Cours, SM: Multimédia
            'capacite' => 'nullable|integer|min:1',           // Optionnel selon le cahier des charges
        ], [
            'code.unique' => 'Rah had salle deja existe.',
            'code.required' => 'Le code de la salle est obligatoire.',
            'type.required' => 'Le type de salle est obligatoire.',
        ]);

        Salle::create($validated);

        return redirect()->route('salles.index')->with('success', 'La salle a été ajoutée avec succès !');
    }

    
    public function edit(Salle $salle)
    {
        return view('admin.salles.edit', compact('salle'));
    }

    
    public function update(Request $request, Salle $salle)
    {
        $validated = $request->validate([
            'code'     => [
                'required',
                'max:20',
                'unique:salles,code,' . $salle->id,
                'regex:/^(SC|SM)-[A-Za-z0-9]+$/',
                function ($attribute, $value, $fail) use ($request) {
                    $type = $request->input('type');
                    if ($type && !str_starts_with($value, $type . '-')) {
                        $fail('Le code doit commencer par ' . $type . '- selon le type de salle choisi.');
                    }
                },
            ],
            'type'     => 'required|in:SC,SM',
            'capacite' => 'nullable|integer|min:1',
        ], [
            'code.unique' => 'Rah had salle deja existe.',
            'code.required' => 'Le code de la salle est obligatoire.',
            'type.required' => 'Le type de salle est obligatoire.',
        ]);

        $salle->update($validated);

        return redirect()->route('salles.index')->with('success', 'Les informations de la salle ont été modifiées !');
    }

    
    public function destroy(Salle $salle)
    {
        if ($salle->seances()->exists()) {
            return back()->with('error', 'Impossible de supprimer cette salle car elle est actuellement occupée dans l\'emploi du temps.');
        }

        $salle->delete();

        return redirect()->route('salles.index')->with('success', 'La salle a été supprimée définitivement.');
    }
}
