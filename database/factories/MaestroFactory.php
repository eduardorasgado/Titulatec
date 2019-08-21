<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Maestro;

$factory->define(Maestro::class, function (Faker $faker) {
    return [
        "cedula_profesional" => $faker->swiftBicNumber,
        "especialidad_estudiada" => $faker->jobTitle,
        "asesor_count" => 0,
        "id_user" => factory(\App\User::class)->create([
            "id_role" => \App\Role::$ROLE_MAESTRO
        ])->id,
        "id_academia" =>$faker->numberBetween($min=1, $max=6)
    ];
});
