<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\AlumnoCarrera;
use Faker\Generator as Faker;

$factory->define(AlumnoCarrera::class, function (Faker $faker) {
    return [
        'id_alumno' => 1,
        'id_especialidad' => null,
        'id_plan_estudios' => null,
    ];
});
