<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // insertando el administrador del sistema
        DB::table('users')->insert([
            'nombre' => 'Eduardo',
            'apellidos' => 'Rasgado Ruiz',
            'email' => 'eduardo.rasgado@hotmail.com',
            'password' => bcrypt(env('ADMIN_PASS', 'password')),
            'is_enable' => true,
            'id_role' => 1
        ]);

    }
}
