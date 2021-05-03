<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    use HasFactory;

    function planning(){
        return $this->hasMany(Planning::class,'cours_id');
    }

    function formation(){
        return $this->belongsTo(Formation::class,'id');
    }

    function user(){
        return $this->belongsTo(User::class,'id');
    }
}
