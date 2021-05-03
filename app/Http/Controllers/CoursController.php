<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\Cours;
use App\Models\User;

class CoursController extends Controller
{
    /*
    *public function index()
    *Permet d'afficher la liste de tous les cours 
    *renvoie l'information à la vue cours_index
    */
    public function index(){
        $cours = Cours::all();
        return view('cours_index',['cours'=>$cours]);
    }

    /*
    *public function create()
    *Affiche le formulaire de création
    *d'un nouveau cours
    */
    public function create(){
        $formation = Formation::all();
        return view('admin.create_cours',['formation'=>$formation]);
    }

    /*
    *public function store(Request $request)
    *Permet de créer un nouveau cours 
    */
    public function store(Request $request){
        $request->validate([
            'intitule_f' =>'required|string|max:50',
            'intitule' =>'required|string|max:50',
        ]);
        $formation = Formation::where('intitule',$request->input('intitule_f'))->first();
        if(!($formation))
            $request->session()->flash('etat','Impossible de créer le cours,formation introuvable');
        else{
            $cours = new Cours();
            $cours->intitule = $request->input('intitule');
            $cours->user_id = 1;
            $cours->formation_id = $formation->id;
            $cours->save();
            $request->session()->flash('etat','Cours ajouté');
        }
        return redirect(to:'/admin/cours');
    }

    /*
    *public function indexstud()
    *Permet d'afficher les cours de la formation
    *dans laquelle l'étudiant est inscrit
    */
    public function indexstud(){
        $user = Auth::user();
        $cours = Cours::where('formation_id',$user->formation_id)->get();
        return view('cours_index',['cours'=>$cours]);
    }

    /*
    *public function indextea()
    *Permet d'afficher les cours 
    *dont on est le responsable
    */
    public function indextea(){
        $user = Auth::user();
        $cours = Cours::where('user_id',$user->id)->get();
        return view('cours_index',['cours'=>$cours]);
    }

    /*
    *public function indexinsciption()
    *Permet d'afficher la liste des cours
    *dans lesquels l'étudiant est inscrit
    */
    public function indexinscription(){
        $user = Auth::user();
        $cours = DB::table('cours')->join('cours_users','cours.id','=','cours_users.cours_id')->select('cours.*')->where('cours_users.user_id',$user->id)->get();
        return view('cours_index',['cours'=>$cours]);
    }

    /**
     *public function detailcours($id)
     *  Permet d'afficher les détails d'un cours
     * grâce au paramètre donnée($id)
     */
    public function detailcours($id){
        $cours = Cours::where('id',$id)->get();
        return view('cours_index',['cours'=>$cours]);
    }

    /*
    *public function searchFormStu()
    *Permet d'afficher le formulaire de recherche 
    *pour rechercher un cours pour un étudiant
    */
    public function searchFormStu(){
        return view('user.student.search_Form_Stu');
    }

    /*
    *public function search(Request $request)
    *Permet d'afficher le cours correspondant
    *(dans la formation de l'etudiant) 
    *à l'intitule transmit par le formulaire
    */
    public function searchcours(Request $request){
        $user = Auth::user();
        $request->validate([
            'intitule' => 'required|string|max:50',
        ]);
        $cours = Cours::where('formation_id',$user->formation_id)
        ->where('intitule',$request->input('intitule'))->get();
        return view('cours_index',['cours'=>$cours]);
    }

    /*
    *public function searchForm()
    *Permet d'afficher le formulaire de recherche 
    *pour rechercher un cours 
    */
    public function searchForm(){
        return view('admin.search_Form');
    }

    /*
    *public function search(Request $request)
    *Permet d'afficher le cours correspondant
    *à l'intitule transmit par le formulaire 
    */
    public function search(Request $request){
        $request->validate([
            'intitule'=>'required|string|max:50',
        ]);
        $cours = Cours::where('intitule',$request->input('intitule'))->get();
        return view('cours_index',['cours'=>$cours]);
    }

    /*
    *public function edit()
    *Affiche le formulaire de 
    *modification d'un cours
    */
    public function edit(){
        return view('admin.form_cours');
    }

    /*
    *public function update(Request $request,$id)
    *permet la modification d'un cours
    *indiqué par la variable passer
    *en paramètre($id)
    */
    public function update(Request $request,$id){
        $request->validate([
            'intitule'=>'string|max:50',
        ]);
        $cours = Cours::findOrFail($id);
        $cours->intitule = $request->input('intitule');
        $cours->save();
        $request->session()->flash('etat','Cours modifié');
        return redirect('/admin/cours');
    }

    /*
    *public function delete($id)
    *permet la suppression d'un cours
    *indiquer par la variable passer
    *en paramètre($id)
    */
    public function delete(Request $request,$id){
        $cours = Cours::findOrFail($id);
        $cours->delete();
        $request->session()->flash('etat','Cours supprimé');
        return redirect('/admin/cours');
    }
    
    /**
     * Affiche la liste des cours dont
     * l'utilisateur (donné par la valeur passée en paramètre)
     * est responsable.
     * Pour l'administrateur
     */
    public function adminindextea($id){
        $user = User::findOrFail($id);
        $cours = Cours::where('user_id',$user->id)->get();
        return view('cours_index',['cours'=>$cours]);
    }
}
