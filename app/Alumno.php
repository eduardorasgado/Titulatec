<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    //
    protected $fillable = [
        'direccion',
        'telefono',
        'otherTECNM',
        'estado',
        'ciudad',
        'lugar_trabajo',
        'puesto_trabajo',
        'generacion',
        'anexo',
        // llaves foraneas
        'id_user',
        'id_proyecto'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function carrera() {
        return $this->hasOne(AlumnoCarrera::class, 'id_alumno');
    }

    public function procesoTitulacion() {
        return $this->hasOne(ProcesoTitulacion::class, 'id_alumno');
    }
}
