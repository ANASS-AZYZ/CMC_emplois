<?php

namespace App\Http\Controllers;

use App\Models\Groupe;
use App\Models\Salle;
use App\Models\Formateur;
use App\Models\Seance;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Had d-data hiya li ghadi t-khlli l-Dashboard i-koun 3amer
        $stats = [
            'groupes' => Groupe::count(),
            'salles' => Salle::count(),
            'formateurs' => Formateur::count(),
            'seances' => Seance::count(),
        ];

        return view('dashboard', compact('stats'));
    }
}