<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seance;
use App\Models\Filiere;
use App\Models\Groupe;
use App\Models\Salle;
use App\Models\Formateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SeanceController extends Controller
{
    
    public function index()
    {
        $seances = Seance::with(['groupe', 'salle', 'formateur'])->get();
        return view('admin.seances.index', compact('seances'));
    }

    
    public function create()
    {
        $groupes = Groupe::all();
        $salles = Salle::all();
        $formateurs = Formateur::all();
        $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
        $creneaux = ['S1', 'S2', 'S3', 'S4'];

        return view('admin.seances.create', compact('groupes', 'salles', 'formateurs', 'jours', 'creneaux'));
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'groupe_id' => 'required|exists:groupes,id',
            'formateur_id' => 'required|exists:formateurs,id',
            'salle_id' => ['nullable', Rule::requiredIf(fn() => $request->input('mode') === 'presentiel'), 'exists:salles,id'],
            'jour' => 'required|string',
            'creneau' => 'required|string',
            'mode' => 'required|in:presentiel,distance',
        ]);

        if ($validated['mode'] === 'distance') {
            $validated['salle_id'] = null;
        }

        $baseQuery = Seance::where('jour', $request->jour)
            ->where('creneau', $request->creneau);

        $issues = [];
        if ((clone $baseQuery)->where('groupe_id', $request->groupe_id)->exists()) {
            $issues[] = 'Le groupe est deja occupe sur ce jour/creneau.';
        }
        if ((clone $baseQuery)->where('formateur_id', $request->formateur_id)->exists()) {
            $issues[] = 'Le formateur est deja affecte sur ce jour/creneau.';
        }
        if (($validated['mode'] ?? null) === 'presentiel' && !empty($validated['salle_id'])
            && (clone $baseQuery)->where('salle_id', $validated['salle_id'])->exists()) {
            $issues[] = 'La salle est deja reservee sur ce jour/creneau.';
        }

        if (!empty($issues)) {
            return back()->withErrors([
                'conflit' => 'Conflit detecte: ' . implode(' ', $issues),
            ])->withInput();
        }

        Seance::create($validated);
        return redirect()->route('seances.index')->with('success', 'Séance ajoutée avec succès !');
    }

    
    public function edit(Seance $seance)
    {
        $groupes = Groupe::all();
        $salles = Salle::all();
        $formateurs = Formateur::all();
        $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
        $creneaux = ['S1', 'S2', 'S3', 'S4'];
        
        return view('admin.seances.edit', compact('seance', 'groupes', 'salles', 'formateurs', 'jours', 'creneaux'));
    }

    
    public function update(Request $request, Seance $seance)
    {
        $validated = $request->validate([
            'groupe_id' => 'required|exists:groupes,id',
            'formateur_id' => 'required|exists:formateurs,id',
            'salle_id' => ['nullable', Rule::requiredIf(fn() => $request->input('mode') === 'presentiel'), 'exists:salles,id'],
            'jour' => 'required|string',
            'creneau' => 'required|string',
            'mode' => 'required|in:presentiel,distance',
        ]);

        if ($validated['mode'] === 'distance') {
            $validated['salle_id'] = null;
        }

        $baseQuery = Seance::where('jour', $request->jour)
            ->where('creneau', $request->creneau)
            ->where('id', '!=', $seance->id);

        $issues = [];
        if ((clone $baseQuery)->where('groupe_id', $request->groupe_id)->exists()) {
            $issues[] = 'Le groupe est deja occupe sur ce jour/creneau.';
        }
        if ((clone $baseQuery)->where('formateur_id', $request->formateur_id)->exists()) {
            $issues[] = 'Le formateur est deja affecte sur ce jour/creneau.';
        }
        if (($validated['mode'] ?? null) === 'presentiel' && !empty($validated['salle_id'])
            && (clone $baseQuery)->where('salle_id', $validated['salle_id'])->exists()) {
            $issues[] = 'La salle est deja reservee sur ce jour/creneau.';
        }

        if (!empty($issues)) {
            return back()->withErrors([
                'conflit' => 'Conflit detecte: ' . implode(' ', $issues),
            ])->withInput();
        }

        $seance->update($validated);
        return redirect()->route('seances.index')->with('success', 'Séance modifiée avec succès !');
    }

    
    public function destroy(Seance $seance)
    {
        $seance->delete();
        return redirect()->route('seances.index')->with('success', 'Séance annulée !');
    }

    public function toggleAbsence(Seance $seance)
    {
        $seance->update([
            'formateur_present' => ! (bool) $seance->formateur_present,
        ]);

        $message = $seance->formateur_present
            ? 'Formateur marque present pour cette seance.'
            : 'Formateur marque absent pour cette seance.';

        return redirect()->route('seances.index')->with('success', $message);
    }

    
    public function showEmploi(Request $request)
    {
        $filieres = Filiere::query()
            ->orderBy('nom')
            ->orderBy('niveau')
            ->get()
            ->unique(function ($filiere) {
                return mb_strtolower(trim($filiere->nom)) . '|' . mb_strtolower(trim($filiere->niveau));
            })
            ->values();
        $formateurs = Formateur::query()->orderBy('nom')->orderBy('prenom')->get();
        $salles = Salle::query()->orderBy('code')->get();
        $selectedFiliere = $request->input('filiere_id');
        $selectedGroupe = $request->input('groupe_id');
        $selectedFormateur = $request->input('formateur_id');
        $selectedSalle = $request->input('salle_id');
        $selectedType = $request->input('type', 'groupe');
        $selectedModeFilter = $request->input('mode_filter');

        $groupesQuery = Groupe::query()->orderBy('code');
        if ($selectedFiliere) {
            $selectedFiliereModel = Filiere::find($selectedFiliere);
            if ($selectedFiliereModel) {
                $nom = trim($selectedFiliereModel->nom);
                $niveau = trim($selectedFiliereModel->niveau);
                $groupesQuery->whereHas('filiere', function ($q) use ($nom, $niveau) {
                    $q->whereRaw('TRIM(nom) = ?', [$nom])
                      ->whereRaw('TRIM(niveau) = ?', [$niveau]);
                });
            }
        }
        $groupes = $groupesQuery->get();

        $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
        $creneaux = ['S1', 'S2', 'S3', 'S4'];
        $emploi = [];

        $query = Seance::with(['formateur', 'salle', 'groupe']);
        if ($selectedType === 'groupe' && $selectedGroupe) {
            $query->where('groupe_id', $selectedGroupe);
        }
        if ($selectedType === 'formateur' && $selectedFormateur) {
            $query->where('formateur_id', $selectedFormateur);
        }
        if ($selectedType === 'salle' && $selectedSalle) {
            $query->where('salle_id', $selectedSalle);
        }
        if (Auth::check() && in_array($selectedModeFilter, ['presentiel', 'distance'], true)) {
            $query->where('mode', $selectedModeFilter);
        }

        $seances = $query->get();
        foreach ($seances as $seance) {
            $emploi[$seance->jour][$seance->creneau] = $seance;
        }

        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role === 'formateur' && !($selectedType === 'groupe' && $selectedGroupe)) {
                $selectedType = 'formateur';
                $formateur = $user->formateur;
                $selectedFormateur = optional($formateur)->id;
                $emploi = [];

                if ($formateur) {
                    $seancesPerso = Seance::with(['groupe', 'salle'])
                        ->where('formateur_id', $formateur->id)
                        ->when(Auth::check() && in_array($selectedModeFilter, ['presentiel', 'distance'], true), function ($q) use ($selectedModeFilter) {
                            $q->where('mode', $selectedModeFilter);
                        })
                        ->get();
                    foreach ($seancesPerso as $s) {
                        $emploi[$s->jour][$s->creneau] = $s;
                    }
                }
            }

            return view('admin.seances.emploi', compact(
                'filieres',
                'groupes',
                'formateurs',
                'salles',
                'selectedType',
                'selectedFiliere',
                'selectedGroupe',
                'selectedFormateur',
                'selectedSalle',
                'selectedModeFilter',
                'jours',
                'creneaux',
                'emploi'
            ));
        }

        return view('stagiaire.emploi', compact(
            'filieres',
            'groupes',
            'selectedFiliere',
            'selectedGroupe',
            'selectedModeFilter',
            'jours',
            'creneaux',
            'emploi'
        ));
    }

    public function groupesByFiliere(Filiere $filiere)
    {
        $nom = trim($filiere->nom);
        $niveau = trim($filiere->niveau);

        $groupes = Groupe::query()
            ->select('groupes.id', 'groupes.code')
            ->join('filieres', 'filieres.id', '=', 'groupes.filiere_id')
            ->whereRaw('TRIM(filieres.nom) = ?', [$nom])
            ->whereRaw('TRIM(filieres.niveau) = ?', [$niveau])
            ->orderBy('groupes.code')
            ->distinct()
            ->get();

        return response()->json($groupes);
    }
}
