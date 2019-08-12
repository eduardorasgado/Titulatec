<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vocal extends Model
{
    //
    protected $table = 'vocales';

    protected $fillable = [
        'id_maestro',
    ];
}
