<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Formation;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterUserController extends Controller
{
    public function showForm(){
        $formation = Formation::all();
        return view('auth.register',['formation'=>$formation]);
    }

    public function store(Request $request){
        $request->validate([
            'nom' => 'required|string|max:40',
            'prenom' => 'required|string|max:40',
            'login' => 'required|string|max:30|unique:users',
            'mdp' => 'required|string|confirmed|max:60',
            'type' => 'required|string|max:10',
            'formation_id' => 'integer',
        ]);

        $user = new User();
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->login = $request->login;
        $user->mdp = Hash::make($request->mdp);
        $user->type = null;
        if($request->formation_id == "0")
            $user->formation_id = null;
        else
            $user->formation_id = $request->formation_id;
        $user->save();
   
        session()->flash('etat','User added');

        return redirect(to:'/');
    }
}
