<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    //
    protected $fillable = [
        'fecha_autorizacion',
        'numero_libro',
        'estado'
    ];
}
