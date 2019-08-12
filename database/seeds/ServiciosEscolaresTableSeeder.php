<?php

use Illuminate\Database\Seeder;

class ServiciosEscolaresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'nombre' => 'Rosario',
            'apellidos' => 'Cuevas Gonzales',
            'email' => 'rosario.cuevas@hotmail.com',
            'password' => bcrypt('rosariorosario1'),
            'is_enable' => true,
            'id_role' => 4
        ]);
    }
}
