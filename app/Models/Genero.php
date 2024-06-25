<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genero extends Model
{
    use HasFactory, SoftDeletes;
    public $timestamps = false;
    protected $primaryKey="code";
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'code','nome'
    ];


    public function filme(){

        return $this->hasMany(Filme::class,'genero_code','code');
    }

}
