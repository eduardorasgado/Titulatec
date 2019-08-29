<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public static $ROLE_ADMIN = 1;
    public static $ROLE_JEFE_ACADEMIA = 2;
    public static $ROLE_SECRETARIA_DIVISION = 3;
    public static $ROLE_SERVICIOS_ESCOLARES = 4;
    public static $ROLE_MAESTRO = 5;
    public static $ROLE_ALUMNO = 6;
    public static $ROLE_JEFE_DIVISION = 7;
    public static $ROLE_COORDINADORA_APOYO_TITULACION = 8;

    //
    protected $fillable = [
        'nombre',
        'descripcion'
    ];

    // relacion uno a muchos, role pertenece a user
    public function users() {
        return $this->hasMany(User::class, 'id_role');
    }
}
