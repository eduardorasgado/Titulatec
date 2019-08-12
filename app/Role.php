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

    // relacion uno a uno, role pertenece a user
    public function role() {
        return $this->belongsTo(User::class, 'id_role');
    }
}
