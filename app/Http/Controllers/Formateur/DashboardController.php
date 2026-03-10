<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use App\Models\Seance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $formateur = $user->formateur; 

        if (!$formateur) {
            return "Erreur : Votre compte n'est pas lié à un formateur. Utilisez Tinker.";
        }

        $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
        $creneaux = ['S1', 'S2', 'S3', 'S4']; 

        // جلب الحصص مع المجموعات والقاعات
        $seances = Seance::with(['groupe', 'salle'])
            ->where('formateur_id', $formateur->id)
            ->get();

        // حساب إجمالي الساعات لتجنب خطأ Undefined variable
        $totalHeures = $seances->count() * 2.5;

        $emploi = [];
        foreach ($seances as $s) {
            $emploi[$s->jour][$s->creneau] = $s;
        }

        return view('formateur.dashboard', compact('emploi', 'jours', 'creneaux', 'formateur', 'totalHeures'));
    }
}