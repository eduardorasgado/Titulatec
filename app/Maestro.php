<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maestro extends Model
{
    //
    protected $fillable = [
        'cedula_profesional',
        'especialidad_estudiada',
        'asesor_count',
        'id_user',
        'id_academia'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function academia() {
        return $this->belongsTo(Academia::class, 'id_academia');
    }
}
