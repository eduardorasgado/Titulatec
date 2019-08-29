<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OpcionTitulacion extends Model
{
    //
    protected $table = "opcion_titulaciones";

    protected $fillable = [
        'clave',
        'nombre',
        'estado'
    ];

    public function procesoTitulaciones() {
        return $this
            ->hasMany(ProcesoTitulacion::class, 'id_opcion_titulacion');
    }
}
