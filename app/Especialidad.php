<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    //
    protected $table = 'especialidades';

    protected $fillable = [
        'nombre',
        'estado',
        'id_academia'
    ];

    public function academia() {
        return $this->belongsTo(Academia::class,
            'id_academia');
    }

    public function planEstudios() {
        return $this->hasMany(
            PlanEstudios::class,
            'id_especialidad'
        );
    }

    public function alumnoCarreras() {
        return $this
            ->hasMany(AlumnoCarrera::class, 'id_especialidad');
    }
}
