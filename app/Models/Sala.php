<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sala extends Model
{
    use HasFactory, SoftDeletes;
    public $timestamps = false;

    protected $fillable = [
        'nome'
    ];

    public function sessoes(){

        return $this->hasMany(Sessao::class,'sala_id','id');
    }

    public function lugares(){

        return $this->hasMany(Lugar::class,'sala_id','id');
    }

    public static function numero_lugares($sessao_id){
        $numero_lugares = Sessao::select(Sessao::raw('COUNT(lugares.sala_id) as numero_lugares'))
        ->join('salas','salas.id','=','sessoes.sala_id')
        ->join('lugares','lugares.sala_id','=','salas.id')
        ->where('sessoes.id','=',$sessao_id)
        ->get();
        return $numero_lugares;
    }

}
