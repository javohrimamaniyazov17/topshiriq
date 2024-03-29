<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login() {
        return view('auth.login');
    }

    public function AuthLogin(Request $request) {
        request()->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);
        if(Auth::attempt([
            'email'=> $request->email,
            'password' => $request->password
        ])){
            return redirect('admin/dashboard');
        }
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }
}
