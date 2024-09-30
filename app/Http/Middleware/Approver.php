<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class Approver
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            // Verifica se o usuário é um aprovador
            if (Auth::user()->profile === 'approver') {
                return $next($request);
            } else {
                // Usuário logado, mas não tem permissão
                Auth::logout();
                return redirect()->route('login')->with('error', 'Precisa fazer login como aprovador.');
            }
        }

        // Usuário não autenticado
        return redirect()->guest(route('login'))->with('error', 'Por favor, faça o login.');
    }
}
