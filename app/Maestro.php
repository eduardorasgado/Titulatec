<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maestro extends Model
{
    //
    protected $fillable = [
        'cedula_profesional',
        'especialidad_estudiada',
        'asesor_count',
        'id_user',
        'id_academia'
    ];
}
