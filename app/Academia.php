<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Academia extends Model
{
    //
    protected $fillable = [
        'nombre',
        'estado'
    ];

    public function especialidades() {
        return $this->hasMany(Especialidad::class,
            'id_academia');
    }

    public function maestros() {
        return $this->hasMany(Maestro::class, 'id_academia');
    }
}
