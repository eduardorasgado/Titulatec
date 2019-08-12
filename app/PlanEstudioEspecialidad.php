<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanEstudioEspecialidad extends Model
{
    //
    protected $table = 'plan_estudio_especialidades';

    protected $fillable = [
        'id_plan_estudios',
        'id_especialidad',
    ];

}
