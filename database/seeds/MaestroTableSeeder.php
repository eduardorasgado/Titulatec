<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaestroTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mail = 'hypatia.montenegro@hotmail.com';

        DB::table('users')->insert([
            'nombre' => 'Hypatia',
            'apellidos' => 'Montenegro Beltrán',
            'email' => $mail,
            'password' => bcrypt('hypatiahypatia1'),
            'is_enable' => true,
            'id_role' => 5,
            'created_at' => date("Y-m-d H:i:s")
        ]);

        $maestra = DB::table('users')->where("email", $mail)->first();

        DB::table('maestros')->insert([
            'id_user' => (int) $maestra->id,
            "cedula_profesional" => "ASLD235253L",
            "especialidad_estudiada" => "Maestría en recursos renovables",
            "asesor_count" => 0,
            "id_academia" => 3,
        ]);

        // creando 50 maestros falsos para poblar la db
        factory(\App\Maestro::class, 50)->create();
    }
}
