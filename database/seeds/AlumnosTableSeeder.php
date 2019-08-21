<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlumnosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $mail = "jose.jose@hotmail.com";

        DB::table('users')->insert([
            'nombre' => 'Jose',
            'apellidos' => 'Jimenez Arteaga',
            'email' => $mail,
            'password' => bcrypt('josejose1'),
            'is_enable' => true,
            'id_role' => 6
        ]);

        $alumno = DB::table("users")->where("email", $mail)->first();

        DB::table("alumnos")->insert([
            'id_user' => $alumno->id,
        ]);
    }
}
