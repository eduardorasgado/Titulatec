<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    //
    protected $fillable = [
        'nombre',
        'producto',
        'num_total_integrantes',
        'conteo_registrados',
        'codigo_compartido',
        'id_creador',
        'is_closed'
    ];
}
