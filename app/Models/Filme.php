<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filme extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo','genero_code','ano','sumario','trailer_url'
    ];


    public function genero(){

        return $this->belongsTo(Filme::class,'genero_code','code')->withTrashed();
    }
    public function sessoes(){

        return $this->hasMany(Filme::class,'filme_id','id');
    }

}

