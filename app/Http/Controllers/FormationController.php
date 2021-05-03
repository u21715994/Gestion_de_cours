<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;

class FormationController extends Controller
{
    /**
     * public function index()
     * Affiche la liste de toute les formations
     */
    public function index(){
        $formation = Formation::all();
        return view('admin.forma_index',['formation'=>$formation]);
    }

    /**
     * public function create()
     * Affiche le formulaire de création
     * d'une nouvelle formation
     */
    public function create(){
        return view('admin.create_forma');
    }

    /**
     * public function store(Request $request)
     * Permet de créer une nouvelle formation
     */
    public function store(Request $request){
        $request->validate([
            'intitule' =>'required|string|max:50',
        ]);
        $formation = new Formation();
        $formation->intitule = $request->input('intitule');
        $formation->save();
        $request->session()->flash('etat','Formation ajouté');
        return redirect(to:'admin/formation');
    }

    /**
     * public function edit()
     * Affiche le formulaire de modification
     * d'une formation déjà existante
     */
    public function edit(){
        return view('admin.form_formation');
    }

    /**
     * public function update(Request $request,$id)
     * Permet de modifier une formation indiquée par 
     * le paramètre ($id) 
     */
    public function update(Request $request,$id){
        $request->validate([
            'intitule' =>'required|string|max:50',
        ]);
        $formation = Formation::findOrFail($id);
        $formation->intitule = $request->input('intitule');
        $formation->save();
        $request->session()->flash('etat','Formation modifié');
        return redirect(to:'admin/formation');
    }

    /**
     * public function delete(Request $request,$id)
     * Permet de supprimer une formation existante
     * indiquée par la valeur en paramètre($id)
     */
    public function delete(Request $request,$id){
        $formation = Formation::findOrFail($id);
        $formation->delete();
        $request->session()->flash('etat','Formation supprimé');
        return redirect(to:'admin/formation');
    }
}
