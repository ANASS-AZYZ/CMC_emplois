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
            'salle_id' => 'required|exists:salles,id',
            'jour' => 'required|string',
            'creneau' => 'required|string',
        ]);

        $conflit = Seance::where('jour', $request->jour)
            ->where('creneau', $request->creneau)
            ->where(function ($q) use ($request) {
                $q->where('groupe_id', $request->groupe_id)
                    ->orWhere('formateur_id', $request->formateur_id)
                    ->orWhere('salle_id', $request->salle_id);
            })
            ->exists();

        if ($conflit) {
            return back()->withErrors([
                'conflit' => 'Conflit detecte ! Impossible de planifier le meme formateur ou la meme salle au meme jour et creneau.',
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
            'salle_id' => 'required|exists:salles,id',
            'jour' => 'required|string',
            'creneau' => 'required|string',
        ]);

        $conflit = Seance::where('jour', $request->jour)
            ->where('creneau', $request->creneau)
            ->where('id', '!=', $seance->id)
            ->where(function ($q) use ($request) {
                $q->where('groupe_id', $request->groupe_id)
                    ->orWhere('formateur_id', $request->formateur_id)
                    ->orWhere('salle_id', $request->salle_id);
            })
            ->exists();

        if ($conflit) {
            return back()->withErrors([
                'conflit' => 'Conflit detecte ! Impossible de planifier le meme formateur ou la meme salle au meme jour et creneau.',
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

        $groupesQuery = Groupe::query()->orderBy('code');
        if ($selectedFiliere) {
            $groupesQuery->where('filiere_id', $selectedFiliere);
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
            'jours',
            'creneaux',
            'emploi'
        ));
    }

    public function groupesByFiliere(Filiere $filiere)
    {
        return response()->json(
            $filiere->groupes()->select('id', 'code')->orderBy('code')->get()
        );
    }
}
