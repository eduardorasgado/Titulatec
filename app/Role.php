<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
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
