<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class Requester
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (Auth::user()->profile === 'requester' ) {
                return $next($request);
            } else {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Precisa fazer o login como solicitante');
            }
        } else {
            return redirect()->route('login')->with('error', 'Precisa fazer o login como solicitante');; // Use guest para armazenar a URL pretendida
        }
    }
}
