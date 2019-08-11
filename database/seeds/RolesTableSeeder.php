<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // creacion del administrador
        DB::table('roles')->insert([
            'nombre' => 'Administrador',
            'descripcion' => 'Nivel más alto de control del sistema',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('roles')->insert([
            'nombre' => 'Jefe de Academia',
            'descripcion' => '2do nivel de control del sistema',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('roles')->insert([
            'nombre' => 'Secretaria de División de estudios',
            'descripcion' => '2do nivel de control del sistema',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('roles')->insert([
            'nombre' => 'Servicios Escolares',
            'descripcion' => '2do nivel de control del sistema',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('roles')->insert([
            'nombre' => 'Maestro',
            'descripcion' => '3er nivel de control del sistema',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('roles')->insert([
            'nombre' => 'Alumno',
            'descripcion' => '4to nivel de control del sistema',
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
