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
        DB::table('users')->insert([
            'nombre' => 'Hypatia',
            'apellidos' => 'Montenegro Beltrán',
            'email' => 'hypatia.montenegro@hotmail.com',
            'password' => bcrypt('hypatiahypatia1'),
            'is_enable' => true,
            'id_role' => 5
        ]);
    }
}
