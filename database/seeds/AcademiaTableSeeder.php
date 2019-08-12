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
                'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('academias')->insert([
            'nombre' => 'Departamento de Metal-Mecanica',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('academias')->insert([
            'nombre' => 'Departameto de Ciencias de la Tierra',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('academias')->insert([
            'nombre' => 'Departamento de Ingenieria Industrial',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('academias')->insert([
            'nombre' => 'Departamento de Electrica y Elecctronica',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('academias')->insert([
            'nombre' => 'Departamento de Ciencias Economico-Administrativas',
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
