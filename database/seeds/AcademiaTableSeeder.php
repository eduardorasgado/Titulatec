<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AcademiaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('academias')->insert([
            'nombre' => 'Departamento de Sistemas y Computacion',
                'estado' => true,
                'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('academias')->insert([
            'nombre' => 'Departamento de Metal-Mecanica',
            'estado' => true,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('academias')->insert([
            'nombre' => 'Departameto de Ciencias de la Tierra',
            'estado' => true,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('academias')->insert([
            'nombre' => 'Departamento de Ingenieria Industrial',
            'estado' => true,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('academias')->insert([
            'nombre' => 'Departamento de Electrica y Elecctronica',
            'estado' => true,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('academias')->insert([
            'nombre' => 'Departamento de Ciencias Economico-Administrativas',
            'estado' => true,
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
