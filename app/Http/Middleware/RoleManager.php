<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleManager
{
    
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userRole = Auth::user()->role;
        $userEmail = Auth::user()->email;

        if ($role === 'admin' && ! ($userRole === 'admin' && $userEmail === 'admin@cmc.ma')) {
            return redirect()->route('formateur.dashboard');
        }
        if ($userRole !== $role) {
            if ($userRole === 'admin') {
                return redirect()->route('dashboard');
            } 
            if ($userRole === 'formateur') {
                return redirect()->route('formateur.dashboard');
            }

            return redirect('/');
        }

        return $next($request);
    }
}
