<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\Cours;
use App\Models\User;

class UserController extends Controller
{
    /**
     * public function formpwd()
     * Affiche le formulaire de modification 
     * du mot de passe
     */
    public function formpwd(){
        return view('user/form_pwd');
    }

    /**
     * public function pwd(Request $request)
     * Permet la modification du mot de passe
     */
    public function pwd(Request $request){
        $user = Auth::user();
        $request->validate([
            'mdp'=>'required|string|max:60',
        ]);
        $user->mdp = Hash::make($request->mdp);
        $user->save();
        if($user->type == "enseignant")
            return redirect(to:"/teacher");
        elseif($user->type == "etudiant")
            return redirect(to:"/student");
        else
            return redirect(to:"/");
    }

    /**
     * public function edit()
     * Affiche le formulaire de modification
     * du nom et prenom
     */
    public function edit(){
        return view('user/form_edit');
    }

    /**
     * public function update(Request $request)
     * Permet la modification du nom et prenom
     */
    public function update(Request $request){
        $user = Auth::user();
        $request->validate([
            'nom'=>'required|string|max:40',
            'prenom'=>'required|string|max:40'
        ]);
        $user->nom = $request->input('nom');
        $user->prenom = $request->input('prenom');
        $user->save();
        if($user->type == "enseignant")
            return redirect(to:"/teacher");
        elseif($user->type == "etudiant")
            return redirect(to:"/student");
        else
            return redirect(to:"/");
    }

    /**
     * public function validated(Request $request,$id)
     * Permet de valider la création d'un utilisateur
     * donner par la valeur passée en paramètre($id)
     */
    public function validated(Request $request,$id){
        $user = User::findOrFail($id);
        if($user->type != null)
            $request->session()->flash('etat','Déjà accepté');
        elseif($user->formation_id == null)
            $user->type = 'enseignant';
        else   
            $user->type = 'etudiant';
        $user->save();
        $request->session()->flash('etat','Utilisateur accepté');
        return redirect(to:'/admin/user');
    }

    /**
     * public function formassociationcours()
     * Affiche le formulaire d'association 
     * d'un cours à un enseignant
     */
    public function formassociationcours(){
        $cours = Cours::all();
        return view('admin.formassociation',['cours'=>$cours]);
    } 

    /**
     * public function associationcours(Request $request,$id)
     * Permet d'associer un cours à un utilisateur donner
     * par la valeur passée en paramètre($id)
     */
    public function associationcours(Request $request,$id){
        $request->validate([
            'intitule'=>'required|string|max:50',
        ]);
        $cours = Cours::where('intitule',$request->input('intitule'))->first();
        $cours->user_id = $id;
        $cours->save();
        return redirect(to:'/admin/cours');
    }    

    /**
     * public function inscriptioncours(Request $request,$id)
     * Permet à un étudiant de s'inscrit à un cours
     * donnée en paramètre($id)
     */
    public function inscriptioncours(Request $request,$id){
        $user = Auth::user();
        $cours = Cours::findOrFail($id);
        $cours_user = DB::select('select * from cours_users where user_id = ? and cours_id = ?',[$user->id,$cours->id]);
        $request->session()->flash('etat','Déjà inscrit');
        if(!($cours_user)){
            $cours_user = DB::insert('insert into cours_users (user_id,cours_id) values (?,?)',[$user->id,$cours->id]);
            $request->session()->flash('etat','Inscription réussi');
        }
        return redirect(to:"/student/cours/inscrit");
    }

    /**
     * public function deinscriptioncours(Request $request,$id)
     * Permet à un étudiant de se desincrit à un cours
     * donnée en paramètre($id)
     */
    public function deinscriptioncours(Request $request,$id){
        $cours = DB::delete('delete from cours_users where user_id = ? and cours_id = ?',[Auth::user()->id,$id]);
        if($cours)
            $request->session()->flash('etat','Déscription réussi');
        else
            $request->session()->flash('etat','Impossible.Pas inscirt à ce cours.Voici la liste des cours ou vous êtes inscrit');
        return redirect(to:"/student/cours/inscrit");
    }

    /**
     * public function index()
     * Permet d'afficher tous les utilisateurs
     */
    public function index(){
        $user = User::all();
        return view('admin/index_user',['user'=>$user]);
    }

    /**
     * public function formindex()
     * Affiche le formulaire d'affichage
     * des utilisateurs selon leur type
     */
    public function formindex(){
        return view('admin.formindex');
    }

    /**
     * public function indextype(Request $request)
     * Permet d'afficher la liste des utilisateurs 
     * en fonction de leur type
     */
    public function indextype(Request $request){
        $request->validate([
            'type' => 'required|string|max:10',
        ]);
        $user = User::where('type',$request->input('type'))->get();
        return view('admin.index_user',['user'=>$user]);
    }

    /**
     * public function form_search_nom
     * Affiche le formulaire de recherche
     * d'un utilisateur en fonction de son nom
     */
    public function form_search_nom(){
        return view('admin.form_search_nom');
    }

    /**
     * public function search_nom(Request $request)
     * Permet d'afficher les utilisateurs ayant pour nom
     * le nom renvoyé par la fonction form_search_nom
     */
    public function search_nom(Request $request){
        $request->validate([
            'nom' => 'string|max:40',
        ]);
        $user = User::where('nom',$request->input('nom'))->get();
        return view('admin.index_user',['user'=>$user]);
    }

    /**
     * public function form_search_prenom
     * Affiche le formulaire de recherche
     * d'un utilisateur en fonction de son prénom
     */
    public function form_search_prenom(){
        return view('admin.form_search_prenom');
    }

    /**
     * public function search_prenom(Request $request)
     * Permet d'afficher les utilisateurs ayant pour prénom
     * le prénom renvoyé par la fonction form_search_prenom
     */
    public function search_prenom(Request $request){
        $request->validate([
            'prenom' => 'string|max:40',
        ]);
        $user = User::where('prenom',$request->input('prenom'))->get();
        return view('admin.index_user',['user'=>$user]);
    }

    /**
     * public function form_search_login
     * Affiche le formulaire de recherche
     * d'un utilisateur en fonction de son login
     */
    public function form_search_login(){
        return view('admin.form_search_login');
    }

    /**
     * public function search_login(Request $request)
     * Permet d'afficher les utilisateurs ayant pour login
     * le login renvoyé par la fonction form_search_login
     */
    public function search_login(Request $request){
        $request->validate([
            'login' => 'string|max:30',
        ]);
        $user = User::where('login',$request->input('login'))->get();
        return view('admin.index_user',['user'=>$user]);
    }

    /**
     * public function create()
     * Affiche le formulaire de créer 
     * d'un nouvel utilisateur
     */
    public function create(){
        $formation = Formation::all();
        return view('auth.register',['formation'=>$formation]);
    }

    /**
     * public function store(Request $request)
     * Permet la créatiion d'un nouvel utilisateur
     */
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
        $user->type = $request->type;
        if($request->formation_id == "0" || $user->type == 'enseignant'){
            $user->formation_id = null;
            $user->type = 'enseignant';
        }else
            $user->formation_id = $request->formation_id;
        $user->save();
        session()->flash('etat','Utilisateur ajouté');
        return redirect(to:'/admin/user');
    }

    /**
     * public function edituser()
     * Affiche le formulaire de modification d'un utilisateur
     * Pour l'administrateur
     */
    public function edituser(){
        $formation = Formation::all();
        return view('admin.edit',['formation'=>$formation]);
    }

    /**
     * public function updateuser(Request $request,$id)
     * Permet de modifier l'utilisateur donné($id)
     */
    public function updateuser(Request $request,$id){
        $request->validate([
            'nom' => 'required|string|max:40',
            'prenom' => 'required|string|max:40',
            'login' => 'required|string|max:30|unique:users',
            'mdp' => 'required|string|confirmed|max:60',
            'type'=>'required|string|max:10',
            'formation_id'=>'integer',
        ]);
        if($request->type == 'etudiant' && $request->formation_id == "0")
            $request->session()->flash('etat',"Erreur.Impossible de modifier l'utilisateur");
        else{
            $user =  User::findOrFail($id);
            $user->nom = $request->nom;
            $user->prenom = $request->prenom;
            $user->login = $request->login;
            $user->mdp = Hash::make($request->mdp);
            $user->type = $request->type;
            if($user->type != 'etudiant' || $request->formation_id == "0")
                $user->formation_id = null;
            else{
                $formation = Formation::where('id',$request->input('formation_id'))->first();
                $user->formation_id = $formation->id;
            }
            $user->save();
            $request->session()->flash('etat','Utilisateur Modifié');
        }
        return redirect(to:'/admin/user');
    }

    /**
     * public function delete(Request $request,$id)
     * permet de supprimer un utilisateur donné($id)
     */
    public function delete(Request $request,$id){
        $user = User::findOrFail($id);
        $user->delete();
        $request->session()->flash('etat','Utilisateur supprimé');
        return redirect(to:'/admin/user');
    }
    
    /**
     * public function formteacher($id)
     * Affiche le formulaire d'association 
     * d'un enseignant à un cours
     */
    public function formteacher(){
        $user = User::all();
        return view('admin.formteacher',['user'=>$user]);
    }
    
    /**
     * public function teacher(Request $request,$id)
     * Permet d'associer un enseignant à un cours 
     * indiquer par la valeur passée en paramètre
     */
    public function teacher(Request $request,$id){
        $request->validate([
            'id' => 'required|integer',
        ]);
        $cours = Cours::findOrFail($id);
        $cours->user_id = $request->input('id');
        $cours->save();
        return redirect(to:'/admin/cours');
    }
}
