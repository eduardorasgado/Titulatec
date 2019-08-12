<?php

use Illuminate\Database\Seeder;

class DivisionDeEstudiosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // secretaria
        DB::table('users')->insert([
            'nombre' => 'Marta',
            'apellidos' => 'Santiago Guerra',
            'email' => 'marta.santiago@hotmail.com',
            'password' => bcrypt('martamarta1'),
            'is_enable' => true,
            'id_role' => 3
        ]);

        // jefe

        DB::table('users')->insert([
            'nombre' => 'Mauricio',
            'apellidos' => 'Solorzano Gomez',
            'email' => 'mauricio.solorzano@hotmail.com',
            'password' => bcrypt('mauriciomauricio1'),
            'is_enable' => true,
            'id_role' => 7
        ]);
    }
}
