<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        return view('admin.login');
    }

    public function store(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'O campo e-mail é obrigatório',
            'email.email' => 'Preencha o campo com um em-mail válido',
            'password.required' => 'O campo senha é obrigatório'
        ]);

        $credentials = $request->only('email', 'password');
        $authenticated = Auth::attempt($credentials);

        if (!$authenticated) {
            return redirect()->route('login.index')->withErrors(['error' => 'E-mail ou senha inválidos']);
        }

        return redirect()->route('admin.index');
    }

    public function destroy() {
        if (Auth::check()) {
            Auth::logout();
        }
        return redirect()->route('login.index');
    }
}
