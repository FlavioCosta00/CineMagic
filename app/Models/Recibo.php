<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recibo extends Model
{
    use HasFactory;

    protected $fillable = [
        'data','nif','nome_cliente','tipo_pagamento','ref_pagamento'
    ];

    public function cliente(){

        return $this->belongsTo(Cliente::class,'cliente_id','id')->withTrashed();
    }

    public function bilhetes(){

        return $this->hasMany(Bilhete::class,'recibo_id','id');
    }

    public static function numero_bilhetes_comprado($sessao_id){
        $numero_bilhetes_comprado = Bilhete::select(Sessao::raw('COUNT(lugar_id) as numero_bilhetes_comprado'))
        ->where('sessao_id','=',$sessao_id)
        ->get();
        return $numero_bilhetes_comprado;
    }

}
