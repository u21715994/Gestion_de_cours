<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function showForm(){
        return view('auth.login');
    }

    // login action
    public function login(Request $request){

        $request->validate([
            'login' => 'required|string',
            'mdp' => 'required|string'
            ]);


        $credentials = ['login' => $request->input('login'), 'password' => $request->input('mdp')];

        if (Auth::attempt($credentials)) {
            if(Auth::user()->type == null){
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                $request->session()->flash('etat','Connexion impossible.Utilisateur non accepté');
                return redirect()->intended('/');
            }else{
                $request->session()->regenerate();

                $request->session()->flash('etat','Login successful');
                if(Auth::user()->type == 'admin')
                    return redirect()->intended('/admin');
               else if(Auth::user()->type == 'enseignant')
                    return redirect()->intended('/teacher');
                else if(Auth::user()->type == 'etudiant')
                    return redirect()->intended('/student');
                else
                    return redirect()->intended('/');
            }
        }

        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ]);
    }

    // logout action
    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
