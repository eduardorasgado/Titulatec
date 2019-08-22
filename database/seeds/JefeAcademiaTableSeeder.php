<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JefeAcademiaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mail = 'pericles.jimenez@hotmail.com';
        //
        DB::table('users')->insert([
            'nombre' => 'Pericles',
            'apellidos' => 'Jimenez Gomez',
            'email' => $mail,
            'password' => bcrypt('periclespericles1'),
            'is_enable' => true,
            'id_role' => \App\Role::$ROLE_JEFE_ACADEMIA
        ]);

        $maestro = DB::table('users')->where("email", $mail)->first();

        DB::table('maestros')->insert([
            'id_user' => (int) $maestro->id,
            "cedula_profesional" => "ASLD235253L4",
            "especialidad_estudiada" => "Maestría en ingeniería mecanica",
            "asesor_count" => 0,
            "id_academia" => 1,
        ]);
    }
}
