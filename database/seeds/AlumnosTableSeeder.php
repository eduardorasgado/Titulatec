<?php

use Illuminate\Database\Seeder;

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
        DB::table('users')->insert([
            'nombre' => 'Jose',
            'apellidos' => 'Jimenez Arteaga',
            'email' => 'jose.jose@hotmail.com',
            'password' => bcrypt('josejose1'),
            'is_enable' => true,
            'id_role' => 6
        ]);
    }
}
