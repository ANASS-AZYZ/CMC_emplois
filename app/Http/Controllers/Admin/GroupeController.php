<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Groupe;
use App\Models\Filiere;
use Illuminate\Http\Request;

class GroupeController extends Controller
{
    private function normalizeName(string $value): string
    {
        $value = mb_strtolower(trim($value));

        return strtr($value, [
            'à' => 'a', 'â' => 'a', 'ä' => 'a',
            'é' => 'e', 'è' => 'e', 'ê' => 'e', 'ë' => 'e',
            'î' => 'i', 'ï' => 'i',
            'ô' => 'o', 'ö' => 'o',
            'ù' => 'u', 'û' => 'u', 'ü' => 'u',
            'ç' => 'c',
            'œ' => 'oe',
        ]);
    }

    private function expectedCodePrefix(Filiere $filiere, string $annee): string
    {
        $year = in_array((string) $annee, ['2', '2ème'], true) ? '2' : '1';
        $nom = $this->normalizeName($filiere->nom);

        if ($year === '1') {
            if (str_contains($nom, 'digital design') || str_contains($nom, 'digitale design')) return 'DES-1';
            if (str_contains($nom, 'developpement digital') || str_contains($nom, 'developement digital')) return 'DEV-1';
            if (str_contains($nom, 'intelligence artificielle')) return 'AI-1';
            if (str_contains($nom, 'infrastructure digitale') || str_contains($nom, 'infra')) return 'ID-1';
        }

        if ($year === '2') {
            if (str_contains($nom, 'web full stack')) return 'DEVOWFS-2';
            if (str_contains($nom, 'applications mobiles') || str_contains($nom, 'application mobile')) return 'DEVOAM-2';
            if (str_contains($nom, 'ui designer')) return 'DESOUI-2';
            if (str_contains($nom, 'ux designer')) return 'DESOUS-2';
            if (str_contains($nom, 'cyber securite') || str_contains($nom, 'cybersecurite')) return 'IDOCS-2';
            if (str_contains($nom, 'systemes et reseaux') || str_contains($nom, 'systemes reseaux')) return 'IDSR-2';
        }

        return $year === '2' ? 'GRP-2' : 'GRP-1';
    }

    
    public function index()
    {
        $groupes = Groupe::with('filiere')->get();
        return view('admin.groupes.index', compact('groupes'));
    }

    
    public function create()
    {
        $filieres = Filiere::query()
            ->orderBy('id')
            ->get()
            ->unique(function ($filiere) {
                return mb_strtolower(trim($filiere->nom) . '|' . trim($filiere->niveau));
            })
            ->values();

        return view('admin.groupes.create', compact('filieres'));
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code'       => [
                'required',
                'unique:groupes,code',
                'max:50',
                function ($attribute, $value, $fail) use ($request) {
                    $filiere = Filiere::find($request->input('filiere_id'));
                    if (! $filiere) {
                        return;
                    }

                    $expectedPrefix = $this->expectedCodePrefix($filiere, (string) $request->input('annee'));
                    if (!str_starts_with($value, $expectedPrefix)) {
                        $fail('Le code doit commencer par ' . $expectedPrefix . '.');
                    }
                },
            ], // Code unique ex: DEVOWFS201 [cite: 55]
            'filiere_id' => [
                'required',
                'exists:filieres,id',
                function ($attribute, $value, $fail) use ($request) {
                    $anneeRaw = (string) $request->input('annee');
                    $annee = in_array($anneeRaw, ['2', '2ème'], true) ? '2ème année' : '1ère année';
                    $filiere = Filiere::find($value);

                    if (! $filiere || $filiere->niveau !== $annee) {
                        $fail('La filière choisie ne correspond pas à l\'année sélectionnée.');
                    }
                },
            ],        // Doit appartenir à une filière 
            'annee'      => 'required|in:1,2,1ère,2ème'           // 1ère ou 2ème année 
        ]);

        $validated['annee'] = in_array((string) $validated['annee'], ['1', '1ère'], true) ? '1ère' : '2ème';

        Groupe::create($validated);

        return redirect()->route('groupes.index')->with('success', 'Groupe créé avec succès !');
    }

    
    public function edit(Groupe $groupe)
    {
        $filieres = Filiere::query()
            ->orderBy('id')
            ->get()
            ->unique(function ($filiere) {
                return mb_strtolower(trim($filiere->nom) . '|' . trim($filiere->niveau));
            })
            ->values();

        return view('admin.groupes.edit', compact('groupe', 'filieres'));
    }

    
    public function update(Request $request, Groupe $groupe)
    {
        $validated = $request->validate([
            'code'       => [
                'required',
                'max:50',
                'unique:groupes,code,' . $groupe->id,
                function ($attribute, $value, $fail) use ($request) {
                    $filiere = Filiere::find($request->input('filiere_id'));
                    if (! $filiere) {
                        return;
                    }

                    $expectedPrefix = $this->expectedCodePrefix($filiere, (string) $request->input('annee'));
                    if (!str_starts_with($value, $expectedPrefix)) {
                        $fail('Le code doit commencer par ' . $expectedPrefix . '.');
                    }
                },
            ],
            'filiere_id' => [
                'required',
                'exists:filieres,id',
                function ($attribute, $value, $fail) use ($request) {
                    $anneeRaw = (string) $request->input('annee');
                    $annee = in_array($anneeRaw, ['2', '2ème'], true) ? '2ème année' : '1ère année';
                    $filiere = Filiere::find($value);

                    if (! $filiere || $filiere->niveau !== $annee) {
                        $fail('La filière choisie ne correspond pas à l\'année sélectionnée.');
                    }
                },
            ],
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
