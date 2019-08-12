<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acta extends Model
{
    // moddelo pendiente de revision
    protected $fillable = [
        'is_generated',
        'fecha_examen_aviso',
        'fecha_generacion',
        'hora_inicio',
        'hora_fin',
        'lugar_protocolo',
        // llaves foraneas
        'id_proceso_titulacion',
        'id_libro'
    ];
}
