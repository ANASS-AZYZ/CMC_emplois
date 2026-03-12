<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\GroupeController;
use App\Http\Controllers\Admin\SalleController;
use App\Http\Controllers\Admin\FormateurController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\SeanceController;
use App\Http\Controllers\Formateur\DashboardController as FormateurDashboard;
use App\Http\Controllers\Formateur\ContactAdminController;
use App\Models\Formateur;
use App\Models\Salle;
use App\Models\Groupe;
use App\Models\Seance;
Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->route('dashboard');
        } elseif ($user->role === 'formateur') {
            return redirect()->route('formateur.dashboard');
        }
    }
    return redirect()->route('login.admin');
})->name('login.page');
Route::get('/consulter-emploi', [SeanceController::class, 'showEmploi'])->name('stagiaire.emploi');
Route::middleware('auth')->get('/mon-emploi', function () {
    $user = Auth::user();

    if ($user->role === 'formateur') {
        return redirect()->route('formateur.dashboard');
    }

    if ($user->role === 'admin') {
        return redirect()->route('seances.emploi', ['type' => 'groupe']);
    }

    return redirect()->route('stagiaire.emploi');
})->name('mon.emploi');
Route::get('/filieres/{filiere}/groupes', [SeanceController::class, 'groupesByFiliere'])->name('filieres.groupes');
Route::middleware(['auth', 'verified', 'role:formateur'])->group(function () {
    Route::get('/formateur/dashboard', [FormateurDashboard::class, 'index'])->name('formateur.dashboard');
    Route::get('/formateur/groupes', [GroupeController::class, 'index'])->name('formateur.groupes');
    Route::get('/formateur/salles', [SalleController::class, 'index'])->name('formateur.salles');
    Route::get('/formateur/emploi', [SeanceController::class, 'showEmploi'])->name('formateur.emploi.view');
    Route::get('/formateur/contact-admin', [ContactAdminController::class, 'create'])->name('formateur.contact-admin.create');
    Route::post('/formateur/contact-admin', [ContactAdminController::class, 'store'])->name('formateur.contact-admin.store');
});
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/dashboard', function () {
        $stats = [
            'formateurs' => Formateur::count(),
            'salles'     => Salle::count(),
            'groupes'    => Groupe::count(),
            'seances'    => Seance::count(),
        ];
        return view('dashboard', compact('stats'));
    })->name('dashboard');
    Route::prefix('admin')->group(function () {
        Route::resource('groupes', GroupeController::class);
        Route::resource('salles', SalleController::class);
        Route::resource('formateurs', FormateurController::class);
        Route::resource('seances', SeanceController::class);
        Route::patch('seances/{seance}/toggle-absence', [SeanceController::class, 'toggleAbsence'])->name('seances.toggle-absence');

        Route::get('messages', [MessageController::class, 'index'])->name('admin.messages.index');
        Route::patch('messages/{message}/read', [MessageController::class, 'markAsRead'])->name('admin.messages.read');
        Route::patch('messages/read-all', [MessageController::class, 'markAllAsRead'])->name('admin.messages.read-all');
        Route::get('emploi', [SeanceController::class, 'showEmploi'])->name('seances.emploi');
    });
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::redirect('/settings', '/settings/theme')->name('settings.index');
    Route::view('/settings/theme', 'settings.theme')->name('settings.theme');
    Route::view('/settings/password', 'settings.password')->name('settings.password');
    Route::view('/settings/lang', 'settings.lang')->name('settings.lang');
    Route::match(['POST', 'PUT'], '/password', [ProfileController::class, 'updatePassword'])->name('password.update');
});

require __DIR__.'/auth.php';
