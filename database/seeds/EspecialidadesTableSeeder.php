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
            'nombre' => 'ARQUITECTURA', // ----------------------- 1
            'estado' => true,
            'id_academia' => 3,
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('especialidades')->insert([
            'nombre' => 'CONTADOR PÚBLICO', // ----------------------- 2
            'estado' => true,
            'id_academia' => 6,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('especialidades')->insert([
            'nombre' => 'INGENIERÍA CIVIL', // ----------------------- 3
            'estado' => true,
            'id_academia' => 3,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('especialidades')->insert([
            'nombre' => 'INGENIERÍA ELÉCTRICA', // ----------------------- 4
            'estado' => true,
            'id_academia' => 5,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('especialidades')->insert([
            'nombre' => 'INGENIERÍA ELECTROMECÁNICA', // ----------------------- 5
            'estado' => true,
            'id_academia' => 2,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('especialidades')->insert([
            'nombre' => 'INGENIERÍA EN GESTIÓN EMPRESARIAL', // ----------------------- 6
            'estado' => true,
            'id_academia' => 6,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('especialidades')->insert([
            'nombre' => 'INGENIERÍA INDUSTRIAL', // ----------------------- 7
            'estado' => true,
            'id_academia' => 4,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('especialidades')->insert([
            'nombre' => 'INGENIERÍA INFORMÁTICA', // ----------------------- 8
            'estado' => true,
            'id_academia' => 1,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('especialidades')->insert([
            'nombre' => 'INGENIERÍA MECATRÓNICA', // ----------------------- 9
            'estado' => true,
            'id_academia' => 5,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('especialidades')->insert([
            'nombre' => 'INGENIERÍA MECÁNICA', // ----------------------- 10
            'estado' => true,
            'id_academia' => 2,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('especialidades')->insert([
            'nombre' => 'INGENIERÍA EN SISTEMAS COMPUTACIONALES', // ----------------------- 11
            'estado' => true,
            'id_academia' => 1,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('especialidades')->insert([
            'nombre' => 'LICENCIATURA EN CONTADURÍA', // ----------------------- 12
            'estado' => true,
            'id_academia' => 6,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('especialidades')->insert([
            'nombre' => 'LICENCIATURA EN INFORMÁTICA', // ----------------------- 13
            'estado' => true,
            'id_academia' => 1,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('especialidades')->insert([
            'nombre' => 'INGENIERIA CIVIL EN DESARROLLO DE LA COMUNIDAD', // ----------------------- 14
            'estado' => true,
            'id_academia' => 3,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('especialidades')->insert([
            'nombre' => 'INGENIERIA CIVIL EN VIAS TERRESTRES', // ----------------------- 15
            'estado' => true,
            'id_academia' => 3,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('especialidades')->insert([
            'nombre' => 'INGENIERIA ELÉCTRICA EN POTENCIA', // ----------------------- 16
            'estado' => true,
            'id_academia' => 5,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('especialidades')->insert([
            'nombre' => 'INGENIERÍA ELECTROMECÁNICA EN PLANTA Y MANTENIMIENTO', // ----------------------- 17
            'estado' => true,
            'id_academia' => 2,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('especialidades')->insert([
            'nombre' => 'INGENIERÍA INDUSTRIAL EN PRODUCCIÓN', // ----------------------- 18
            'estado' => true,
            'id_academia' => 4,
            'created_at' => date("Y-m-d H:i:s")
        ]);

    }
}
