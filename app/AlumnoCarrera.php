<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlumnoCarrera extends Model
{
    //
    protected $fillable = [
        // llaves foraneas
        'id_alumno',
        'id_especialidad',
        'id_plan_estudios'
    ];
}
