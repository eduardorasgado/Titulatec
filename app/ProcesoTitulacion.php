<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcesoTitulacion extends Model
{
    //
    protected $table = 'proceso_titulaciones';

    protected $fillable = [
        'datos_generales',
        'solicitud_titulacion',
        'memorandum',
        'registro_proyecto',
        'avisos',
        'is_proceso_finished',
        'id_alumno',
        'id_opcion_titulacion',
        'id_asesores'
    ];

    public function alumno() {
        return $this->belongsTo(Alumno::class, 'id_alumno');
    }
}
