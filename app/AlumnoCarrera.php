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


    public function alumno() {
        return $this->belongsTo(Alumno::class, 'id_alumno');
    }

    public function planEstudio() {
        return $this
            ->belongsTo(PlanEstudios::class, 'id_plan_estudios');
    }


    public function scopeGetByIdAlumno($query, $idAlumno) {
        return $query->where('id', $idAlumno)->first();
    }
}
