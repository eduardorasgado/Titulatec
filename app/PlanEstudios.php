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
}
