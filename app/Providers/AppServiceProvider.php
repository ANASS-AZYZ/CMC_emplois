<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    
    protected function authenticated(Request $request, $user)
{
    if ($user->role === 'admin') {
        return redirect()->intended(RouteServiceProvider::HOME);
    }
    return redirect()->route('formateur.dashboard');
}

    public function register(): void
    {
    }

    
    public function boot(): void
    {
    }
}

