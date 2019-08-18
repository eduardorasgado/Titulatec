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
}
