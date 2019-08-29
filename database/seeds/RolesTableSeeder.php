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
        // 1
        DB::table('roles')->insert([
            'nombre' => 'Administrador',
            'descripcion' => 'Nivel más alto de control del sistema',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        // 2
        DB::table('roles')->insert([
            'nombre' => 'Jefe de Academia',
            'descripcion' => '2do nivel de control del sistema',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        // 3
        DB::table('roles')->insert([
            'nombre' => 'Secretaria de División de Estudios Profesionales',
            'descripcion' => '2do nivel de control del sistema',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        // 4
        DB::table('roles')->insert([
            'nombre' => 'Servicios Escolares',
            'descripcion' => '2do nivel de control del sistema',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        // 5
        DB::table('roles')->insert([
            'nombre' => 'Maestro',
            'descripcion' => '3er nivel de control del sistema',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        // 6
        DB::table('roles')->insert([
            'nombre' => 'Alumno',
            'descripcion' => '4to nivel de control del sistema',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        // 7
        DB::table('roles')->insert([
            'nombre' => 'Jefe de División de Estudios Profesionales',
            'descripcion' => '2do nivel de control del sistema',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        // 8
        DB::table('roles')->insert([
            'nombre' => 'Coordinador(a) de Apoyo a Titulación',
            'descripcion' => '2do nivel de control del sistema',
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
