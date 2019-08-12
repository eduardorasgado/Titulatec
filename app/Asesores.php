<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asesores extends Model
{
    //
    protected $fillable = [
        // llaves foraneas
        'id_proceso_titulacion',
        'id_presidente',
        'id_secretario',
        'id_vocal',
        'id_vocal_suplente'
    ];
}
