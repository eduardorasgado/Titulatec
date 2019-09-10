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

    public function opcionTitulacion() {
        return $this
            ->belongsTo(OpcionTitulacion::class, 'id_opcion_titulacion');
    }

    public function scopeWithOpcionTitulacion($query, $idAlumno) {
        return $query->with('opcionTitulacion')
            ->where('id_alumno', $idAlumno);
    }

    public function scopeFindByAlumnoId($query, $alumnoId){
        return $query
            ->where('id_alumno', $alumnoId);
    }
}
