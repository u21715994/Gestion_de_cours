<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Planning;
use App\Models\Cours;
use App\Models\User;

class PlanningController extends Controller
{
    /**
     * public function indexstu()
     * Affiche les plannings de tout les cours
     * dans lesquels on est inscrit
     */
    public function indexstu(){
        $user = Auth::user();
        $planning = DB::table('plannings')->join('cours_users','plannings.cours_id','=','cours_users.cours_id')->select('plannings.*')->where('cours_users.user_id',$user->id)->get();
        return view('planning_index',['planning'=>$planning]);
    }

    /**
     * public function indexcoursstu($id)
     * Affiche le planning du cours 
     * donné par la valeur passée en paramètre
     */
    public function indexcoursstu($id){
        $planning = Planning::where('cours_id',$id)->get();
        return view('planning_index',['planning'=>$planning]);
    }

    /**
     * public function indextea()
     * Affiche les plannings de tout les cours
     * dont on est responsable
     */
    public function indextea(){
        $user = Auth::user();
        $planning = DB::table('plannings')->join('cours','plannings.cours_id','=','cours.id')->select('plannings.*')->where('cours.user_id',$user->id)->get();
        return view('planning_index',['planning'=>$planning]);
    }
    /*
    public function weekformtea(){
        return view('formweek_pl');
    }

    public function indexweektea(Request $request){
        $request->validate([
            'planning_week'=>'required|date',
        ]);
        echo $request->input('planning_week');
    }*/

    /**
     * public function indexcourstea($id)
     * Affiche le planning du cours 
     * donné par la valeur passée en paramètre
     */
    public function indexcourstea($id){
        $planning = Planning::where('cours_id',$id)->get();
        return view('planning_index',['planning'=>$planning]);
    }

    /**
     * public function creaatecourspl()
     * Affiche le formulaire de création
     * d'un nouveau planning
     */
    public function createcourspl(){
        return view('create_pl');
    }

    /**
     * public function storecours()
     * Crée un nouveau planning
     */
    public function storecours(Request $request,$id){
        $request->validate([
            'date_d'=>'required|date',
            'date_f'=>'required|date',
        ]);
        $cours = Cours::where('id',$id)->get();
        $planning = new Planning();
        $planning->date_debut = $request->input('date_d');
        $planning->date_fin = $request->input('date_f');
        $planning->cours_id = $id;
        $planning->save();
        $request->session()->flash('etat','Planning ajouté');
        if(Auth::user()->type == 'admin')
            return redirect(to:'/admin/user');
        return redirect(to:'/teacher/planning');
    }

    /**
     * public function edit()
     * Affiche le formulaire de modification d'un planning
     */
    public function edit(){
        return view('update_pl');
    }

    /**
     * public function update(Request $request,$id)
     * Permet la modification d'un planning
     * indiqué par le paramètre $id
     */
    public function update(Request $request,$id){
        $request->validate([
            'date_d'=>'required|date',
            'date_f'=>'required|date',
        ]);
        $planning = Planning::findOrFail($id);
        $planning->date_debut = $request->input('date_d');
        $planning->date_fin = $request->input('date_f');
        $planning->save();
        $request->session()->flash('etat','Planning modifié');
        if(Auth::user()->type == 'admin'){
            return redirect(to:'/admin/user');
        }
        return redirect(to:'/teacher/planning');
    }

    /**
     * public function deletecourspl($id)
     * Supprime un planning donnée 
     * par le paramètre $id
     */
    public function deletecourspl(Request $request,$id){
        $planning = Planning::findOrFail($id);
        $planning->cours_id = 0;
        $planning->delete();
        $request->session()->flash('etat','Planning supprimé');
        if(Auth::user()->type == 'admin'){
            return redirect(to:'/admin/user');
        }
        return redirect(to:'/teacher/planning');
    }

    /**
     * public function plannings($id)
     * Affiche la page d'accueil de la gestion des plannings
     * pour l'administrateur
     */
    public function plannings($id){
        return view('admin.plannings',['id'=>$id]);
    }

    /**
     * public function planningsindexadmin($id)
     * Affiche la liste des plannings dont l'utilisateur
     * passé en paramètre est responsable 
     * Pour l'administrateur
     */
    public function planningsindexadmin($id){
        $user = User::findOrFail($id);
        $planning = DB::table('plannings')->join('cours','plannings.cours_id','=','cours.id')->select('plannings.*')->where('cours.user_id',$user->id)->get();
        return view('planning_index',['planning'=>$planning]);
    }

    /**
     * public function planningscoursindexadmin($id)
     * Affiche la liste des plannings pour 
     * le cours passé en paramètre
     * Pour l'administrateur
     */
    public function planningscoursindexadmin($id){
        $cours = Cours::findOrFail($id);
        $planning = Planning::where('cours_id',$cours->id)->get();
        return view('planning_index',['planning'=>$planning]);
    }
}
