<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EspecialidadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // cada una de las especialidades que son introducidas aqui
        // van a depender de las academias ya existentes
        DB::table('especialidades')->insert([
            'nombre' => 'ARQUITECTURA',
            'estado' => true,
            'id_academia' => 3,
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('especialidades')->insert([
            'nombre' => 'CONTADOR PÚBLICO',
            'estado' => true,
            'id_academia' => 6,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('especialidades')->insert([
            'nombre' => 'INGENIERÍA CIVIL',
            'estado' => true,
            'id_academia' => 3,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('especialidades')->insert([
            'nombre' => 'INGENIERÍA ELÉCTRICA',
            'estado' => true,
            'id_academia' => 5,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('especialidades')->insert([
            'nombre' => 'INGENIERÍA ELECTROMECÁNICA',
            'estado' => true,
            'id_academia' => 2,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('especialidades')->insert([
            'nombre' => 'INGENIERÍA EN GESTIÓN EMPRESARIAL',
            'estado' => true,
            'id_academia' => 6,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('especialidades')->insert([
            'nombre' => 'INGENIERÍA INDUSTRIAL',
            'estado' => true,
            'id_academia' => 4,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('especialidades')->insert([
            'nombre' => 'INGENIERÍA INFORMÁTICA',
            'estado' => true,
            'id_academia' => 1,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('especialidades')->insert([
            'nombre' => 'INGENIERÍA MECATRÓNICA',
            'estado' => true,
            'id_academia' => 5,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('especialidades')->insert([
            'nombre' => 'INGENIERÍA MECÁNICA',
            'estado' => true,
            'id_academia' => 2,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('especialidades')->insert([
            'nombre' => 'INGENIERÍA EN SISTEMAS COMPUTACIONALES',
            'estado' => true,
            'id_academia' => 1,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('especialidades')->insert([
            'nombre' => 'LICENCIATURA EN CONTADURÍA',
            'estado' => true,
            'id_academia' => 6,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('especialidades')->insert([
            'nombre' => 'LICENCIATURA EN INFORMÁTICA',
            'estado' => true,
            'id_academia' => 1,
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
