<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\GroupeController;
use App\Http\Controllers\Admin\SalleController;
use App\Http\Controllers\Admin\FormateurController;
use App\Http\Controllers\Admin\SeanceController;
use App\Http\Controllers\Formateur\DashboardController as FormateurDashboard;
use App\Models\Formateur;
use App\Models\Salle;
use App\Models\Groupe;
use App\Models\Seance;

/*
|--------------------------------------------------------------------------
| Web Routes - Projet CMC Emploi (Anass AZYZ)
|--------------------------------------------------------------------------
*/

// [1] LANDING PAGE & AUTO-REDIRECT
// Kat-chouf l-role o kat-siftek nishan l-dashboard dyalk ila knti m-login
Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->route('dashboard');
        } elseif ($user->role === 'formateur') {
            return redirect()->route('formateur.dashboard');
        }
    }
    return view('welcome');
})->name('login.page');

// [2] ROUTE PUBLIC (L-Stagiaire)
// Bla Auth, bach l-stagiaire i-chouf l-emploi dyalo nishan
Route::get('/consulter-emploi', [SeanceController::class, 'showEmploi'])->name('stagiaire.emploi');

// [3] ROUTES DIAL L-FORMATEUR (Consultation Seule)
// Had l-group protected b Middleware 'role:formateur' bach l-admin ma-idkholch l-hadi
Route::middleware(['auth', 'verified', 'role:formateur'])->group(function () {
    Route::get('/formateur/dashboard', [FormateurDashboard::class, 'index'])->name('formateur.dashboard');
    
    // Consultation dyal l-groupes o l-salles (Ghir l-Index / Consultation)
    Route::get('/formateur/groupes', [GroupeController::class, 'index'])->name('formateur.groupes');
    Route::get('/formateur/salles', [SalleController::class, 'index'])->name('formateur.salles');
    
    // Consultation dial l-emploi kamel m3a l-filtres
    Route::get('/formateur/emploi', [SeanceController::class, 'showEmploi'])->name('formateur.emploi.view');
});

// [4] ROUTES DIAL L-ADMIN (Full Access)
// Protected b Middleware 'role:admin' bach l-formateur ma-y-qder i-modifi walu
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    
    // Main Dashboard dial Admin m3a l-stats
    Route::get('/dashboard', function () {
        $stats = [
            'formateurs' => Formateur::count(),
            'salles'     => Salle::count(),
            'groupes'    => Groupe::count(),
            'seances'    => Seance::count(),
        ];
        return view('dashboard', compact('stats'));
    })->name('dashboard');

    // CRUD Complet dial l-Admin (Resources)
    Route::prefix('admin')->group(function () {
        Route::resource('groupes', GroupeController::class);
        Route::resource('salles', SalleController::class);
        Route::resource('formateurs', FormateurController::class);
        Route::resource('seances', SeanceController::class);
        
        // Planning complet dial l-Admin
        Route::get('emploi', [SeanceController::class, 'showEmploi'])->name('seances.emploi');
    });
});

// [5] COMMON ROUTES (Profile)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';