<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role  Le rôle requis pour accéder à la route (admin ou formateur)
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // 1. Check ila l-user m-login 
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userRole = Auth::user()->role;

        // 2. Check ila l-user 3ndu l-role s7i7 bach yd-khel l-had l-route [cite: 101, 172]
        if ($userRole !== $role) {
            
            // Redirect l-Admin l-dashboard dyalo [cite: 103, 140]
            if ($userRole === 'admin') {
                return redirect()->route('dashboard');
            } 
            
            // Redirect l-Formateur l-espace dyalo [cite: 119, 154]
            if ($userRole === 'formateur') {
                return redirect()->route('formateur.dashboard');
            }

            // Redirect par défaut (Stagiaire ou autre) [cite: 131, 162]
            return redirect('/');
        }

        return $next($request);
    }
}