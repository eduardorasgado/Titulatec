<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcesoTitulacion extends Model
{
    //
    protected $fillable = [
        'datos_generales',
        'solicitud_titulacion',
        'memorandum',
        'registro_proyecto',
        'avisos',
        'is_proceso_finished',
        'id_alumno',
        'id_opcion_titulacion'
    ];
}
