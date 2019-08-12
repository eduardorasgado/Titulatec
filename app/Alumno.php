<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    //
    protected $fillable = [
        'direccion',
        'telefono',
        'otherTECNM',
        'estado',
        'ciudad',
        'lugar_trabajo',
        'puesto_trabajo',
        'generacion',
        'anexo',
        // llaves foraneas
        'id_user',
        'id_proyecto'
    ];
}
