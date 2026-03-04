<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    protected function authenticated(Request $request, $user)
{
    if ($user->role === 'admin') {
        return redirect()->intended(RouteServiceProvider::HOME);
    }
    
    // Redirect l l-formateur dashboard
    return redirect()->route('formateur.dashboard');
}

    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
