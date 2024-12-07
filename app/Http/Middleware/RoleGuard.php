<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class RoleGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$role): Response
    {
        if (!Auth::check()) {
            return redirect('/')->with('error', 'Silakan login terlebih dahulu.');
        }
    
    
        Log::info('Roles Parameter Raw: ' . json_encode($role));
    
        $userRole = Auth::user()->role;
    
        if (!in_array($userRole, $role)) {
            return redirect()->route('fallback')->with('error', 'Akses tidak diizinkan.');
        }
    
        return $next($request);
    }
}
