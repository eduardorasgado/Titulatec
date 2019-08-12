<?php

use Illuminate\Database\Seeder;

class JefeAcademiaTableSeeder extends Seeder
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
            'nombre' => 'Pericles',
            'apellidos' => 'Jimenez Gomez',
            'email' => 'pericles.jimenez@hotmail.com',
            'password' => bcrypt('periclespericles1'),
            'is_enable' => true,
            'id_role' => 2
        ]);
    }
}
