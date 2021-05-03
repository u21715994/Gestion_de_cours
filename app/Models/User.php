<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    public $timestamps = false;

    protected $hidden = ['mdp'];

    protected $fillable = ['login', 'mdp', 'type'];

    protected $attributes = [
        'type' => 'user'
    ];


     public function getAuthPassword(){
        return $this->mdp;
    }

    public function isAdmin(){
         return $this->type == 'admin';
    }

    public function isStudent(){
        return $this->type == 'etudiant';
    }

    public function isTeacher(){
        return $this->type == 'enseignant';
    }

    function cours(){
        return $this->hasMany(Cours::class,'id');
    }

    function formation(){
        return $this->belongsTo(Formation::class,'id');
    }

}
