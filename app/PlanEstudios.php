<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanEstudios extends Model
{
    //
    protected $fillable = [
        'clave',
        'is_actual',
        'estado',
        'id_especialidad'
    ];

    public function especialidad() {
        return $this->belongsTo(Especialidad::class,
            'id_especialidad');
    }

    public function AlumnoCarreras() {
        $this->hasMany(AlumnoCarrera::class, 'id_plan_estudios');
    }

    public function scopeGetAllByEspecialidad($query, $idEspecialidad) {
        return $query->where('id_especialidad', $idEspecialidad);
    }
}
