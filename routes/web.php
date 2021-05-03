<?php

use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\PlanningController;
use App\Http\Controllers\RegisterUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/','main');

Route::view('/student','user.student.home')->middleware('auth')->middleware('is_student');
Route::view('/teacher','user.teacher.teach_home')->middleware('auth')->middleware('is_teacher');
//User
Route::middleware(['auth'])->group(function (){
Route::get('/student/pwd',[UserController::class,'formpwd'])->middleware('is_student');
Route::put('/student/pwd',[UserController::class,'pwd'])->middleware('is_student');

Route::get('/teacher/pwd',[UserController::class,'formpwd'])->middleware('is_teacher');
Route::put('/teacher/pwd',[UserController::class,'pwd'])->middleware('is_teacher');

Route::get('/student/update',[UserController::class,'edit'])->middleware('is_student');
Route::put('/student/update',[UserController::class,'update'])->middleware('is_student');

Route::get('/teacher/update',[UserController::class,'edit'])->middleware('is_teacher');
Route::put('/teacher/update',[UserController::class,'update'])->middleware('is_teacher');

Route::get('/admin/{id}/user/validated',[UserController::class,'validated'])->middleware('is_admin');

Route::get('/admin/{id}/user/association',[UserController::class,'formassociationcours'])->middleware('is_admin');
Route::post('/admin/{id}/user/association',[UserController::class,'associationcours'])->middleware('is_admin');

Route::get('/student/{id}/inscription',[UserController::class,'inscriptioncours'])->middleware('is_student'); 

Route::get('/student/{id}/deinscription',[UserController::class,'deinscriptioncours'])->middleware('is_student');

Route::get('/admin/user',[UserController::class,'index'])->middleware('is_admin');
//liste déroulante
Route::get('/admin/user/type',[UserController::class,'formindex'])->middleware('is_admin');
Route::post('/admin/user/type',[UserController::class,'indextype'])->middleware('is_admin');

Route::get('/admin/user/search/nom',[UserController::class,'form_search_nom'])->middleware('is_admin');
Route::post('/admin/user/search/nom',[UserController::class,'search_nom'])->middleware('is_admin');

Route::get('/admin/user/search/prenom',[UserController::class,'form_search_prenom'])->middleware('is_admin');
Route::post('/admin/user/search/prenom',[UserController::class,'search_prenom'])->middleware('is_admin');

Route::get('/admin/user/search/login',[UserController::class,'form_search_login'])->middleware('is_admin');
Route::post('/admin/user/search/login',[UserController::class,'search_login'])->middleware('is_admin');

Route::get('/admin/user/create',[UserController::class,'create'])->middleware('is_admin');
Route::post('/admin/user/create',[UserController::class,'store'])->middleware('is_admin');

Route::get('/admin/{id}/user/update',[UserController::class,'edituser'])->middleware('is_admin');
Route::put('/admin/{id}/user/update',[UserController::class,'updateuser'])->middleware('is_admin');

Route::get('/admin/{id}/user/delete',[UserController::class,'delete'])->middleware('is_admin');

Route::get('/admin/{id}/teacher/cours',[UserController::class,'formteacher'])->middleware('is_admin');
Route::post('/admin/{id}/teacher/cours',[UserController::class,'teacher'])->middleware('is_admin');

//Cours
Route::get('/admin/cours',[CoursController::class,'index'])->middleware('is_admin');

Route::get('/admin/cours/create',[CoursController::class,'create'])->middleware('is_admin');
Route::post('/admin/cours/create',[CoursController::class,'store'])->middleware('is_admin');

Route::get('/student/cours',[CoursController::class,'indexstud'])->middleware('is_student');

Route::get('/student/cours/inscrit',[CoursController::class,'indexinscription'])->middleware('is_student'); 
Route::get('/student/{id}/cours/inscrit',[CoursController::class,'detailcours'])->middleware('is_student');

Route::get('/teacher/cours',[CoursController::class,'indextea'])->middleware('is_teacher');

Route::get('/student/cours/search',[CoursController::class,'searchFormStu'])->middleware('is_student');
Route::post('/student/cours/search',[CoursController::class,'searchcours'])->middleware('is_student');

Route::get('/admin/cours/search',[CoursController::class,'searchForm'])->middleware('is_admin');
Route::post('/admin/cours/search',[CoursController::class,'search'])->middleware('is_admin');

Route::get('/admin/{id}/cours/update',[CoursController::class,'edit'])->middleware('is_admin');
Route::put('/admin/{id}/cours/update',[CoursController::class,'update'])->middleware('is_admin');

Route::get('/admin/{id}/cours/delete',[CoursController::class,'delete'])->middleware('is_admin');

Route::get('admin/{id}/cours/teacher',[CoursController::class,'adminindextea'])->middleware('is_admin');

Route::get('/teacher/{id}/detail',[CoursController::class,'detailcours'])->middleware('is_teacher');

Route::get('/admin/{id}/detail',[CoursController::class,'detailcours'])->middleware('is_admin');

Route::get('/student/{id}/detail',[CoursController::class,'detailcours'])->middleware('is_student');

//Formation
Route::get('/admin/formation',[FormationController::class,'index'])->middleware('is_admin');

Route::get('/admin/formation/create',[FormationController::class,'create'])->middleware('is_admin');
Route::post('/admin/formation/create',[FormationController::class,'store'])->middleware('is_admin');

Route::get('/admin/{id}/formation/update',[FormationController::class,'edit'])->middleware('is_admin');
Route::put('/admin/{id}/formation/update',[FormationController::class,'update'])->middleware('is_admin');

Route::get('/admin/{id}/formation/delete',[FormationController::class,'delete'])->middleware('is_admin');

//Planning
Route::get('/student/planning',[PlanningController::class,'indexstu'])->middleware('is_student');

Route::get('/student/{id}/planning/cours',[PlanningController::class,'indexcoursstu'])->middleware('is_student');

Route::get('/teacher/planning',[PlanningController::class,'indextea'])->middleware('is_teacher');;

Route::get('/teacher/{id}/planning/cours',[PlanningController::class,'indexcourstea'])->middleware('is_teacher');;

Route::get('/teacher/{id}/planning/create',[PlanningController::class,'createcourspl'])->middleware('is_teacher');;
Route::post('/teacher/{id}/planning/create',[PlanningController::class,'storecours'])->middleware('is_teacher');;

Route::get('/teacher/{id}/planning/update',[PlanningController::class,'edit'])->middleware('is_teacher');
Route::put('/teacher/{id}/planning/update',[PlanningController::class,'update'])->middleware('is_teacher');

Route::get('/teacher/{id}/planning/delete',[PlanningController::class,'deletecourspl'])->middleware('is_teacher');

Route::get('/admin/{id}/plannings',[PlanningController::class,'plannings'])->middleware('is_admin');

Route::get('/admin/{id}/cours/planning/teacher',[PlanningController::class,'planningsindexadmin'])->middleware('is_admin');

Route::get('/admin/{id}/cours/plannings',[PlanningController::class,'planningscoursindexadmin'])->middleware('is_admin');

Route::get('/admin/{id}/planning/create',[PlanningController::class,'createcourspl'])->middleware('is_admin');
Route::post('/admin/{id}/planning/create',[PlanningController::class,'storecours'])->middleware('is_admin');

Route::get('/admin/{id}/planning/update',[PlanningController::class,'edit'])->middleware('is_admin');
Route::put('/admin/{id}/planning/update',[PlanningController::class,'update'])->middleware('is_admin');

Route::get('/admin/{id}/planning/delete',[PlanningController::class,'deletecourspl'])->middleware('is_admin');
});

Route::view('/admin','admin.admin_home')->middleware('auth')->middleware('is_admin');

//Login|Logout
Route::get('/login', [AuthenticatedSessionController::class,'showForm'])
    ->name('login');
Route::post('/login', [AuthenticatedSessionController::class,'login']);
Route::get('/logout', [AuthenticatedSessionController::class,'logout'])
    ->name('logout')->middleware('auth');

Route::get('/register', [RegisterUserController::class,'showForm'])
    ->name('register');
Route::post('/register', [RegisterUserController::class,'store']);

