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
    ];

    public function alumno() {
        return $this->belongsTo(Alumno::class, 'id_alumno');
    }

    public function opcionTitulacion() {
        return $this
            ->belongsTo(OpcionTitulacion::class, 'id_opcion_titulacion');
    }

    public function asesores() {
        return $this->hasOne(Asesores::class, 'id_proceso_titulacion');
    }

    public function scopeWithOpcionTitulacion($query, $idAlumno) {
        return $query->with('opcionTitulacion')
            ->where('id_alumno', $idAlumno);
    }

    public function scopeFindByAlumnoId($query, $alumnoId){
        return $query
            ->where('id_alumno', $alumnoId);
    }

    /**
     *
     * Conseguir todos los alumnos con memorandum completo y un registro de proyecto dado
     * por el usuario mas la academia.
     * @param $query
     * @param $registroProyecto
     * @param $idAcademia
     * @return mixed
     */
    public function scopeFullDataFindByRegistroProyectoAndidAcademia(
        $query, $registroProyecto, $idAcademia
    ) {
        return $query->with([
            'alumno.user',
            'alumno.carrera'
        ])
            ->where('memorandum', true)
            ->where('registro_proyecto', $registroProyecto)
            ->whereHas('alumno.carrera.especialidad', function ($query) use ($idAcademia) {
                //dd($query);
                $query->where('id_academia', $idAcademia);
            });
    }
}
