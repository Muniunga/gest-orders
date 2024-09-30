<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class AuthController extends Controller
{
    //
    public function login()
    {
        // Se o usuário já estiver autenticado, redireciona conforme o perfil
        if (Auth::check()) {
            if (Auth::user()->profile === 'requester') {
                return redirect()->route('home');
            } else if (Auth::user()->profile === 'approver') {
                return redirect()->route('orders');
            }
        }
        return view('auth.login'); // Caso contrário, exibe a página de login
    }

    public function AuthLogin(Request $request)
    {
        $remember = !empty($request->remember);

        // Autenticação do usuário
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            // Verifica se há uma URL armazenada no guest e redireciona para lá ou para o padrão
            if (Auth::user()->profile === 'requester') {
                return redirect()->intended(route('home')); // Redireciona para a home se for solicitante
            } else if (Auth::user()->profile === 'approver') {
                return redirect()->intended(route('orders')); // Redireciona para os pedidos se for aprovador
            }
        } else {
            // Retorna ao login com erro se as credenciais estiverem erradas
            return redirect()->back()->with('error', 'Email ou palavra-passe incorretos.');
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect(url('/'));
    }
}
