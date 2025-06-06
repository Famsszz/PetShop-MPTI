<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KasirMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $role = Auth::user()->Peran;
    
        // List peran yang diizinkan
        $allowedRoles = ['Kasir', 'Admin'];
    
        // Cek apakah peran pengguna terdapat dalam list yang diizinkan
        if (in_array($role, $allowedRoles)) {
            DB::setDefaultConnection($request->user()->Peran);
            return $next($request);
        } else {
            return back()->with("error", "Role anda tidak diizinkan");
        }
    }
}
