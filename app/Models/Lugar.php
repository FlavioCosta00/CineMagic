<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lugar extends Model
{
    use HasFactory, SoftDeletes;
    protected $table="Lugares";
    public $timestamps = false;

    protected $fillable = [
        'sala_id','fila','posicao'
    ];

    public function bilhetes(){

        return $this->hasMany(Bilhete::class,'sala_id','id');
    }


    public function sala(){

        return $this->belongsTo(Sala::class,'sala_id','id');
    }



}
