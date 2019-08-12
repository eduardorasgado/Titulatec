<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        Model::unguard();

        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(AlumnosTableSeeder::class);
        $this->call(OpcionTitulacionTableSeeder::class);
        $this->call(JefeAcademiaTableSeeder::class);
        $this->call(MaestroTableSeeder::class);
        $this->call(DivisionDeEstudiosTableSeeder::class);
        $this->call(ServiciosEscolaresTableSeeder::class);

        Model::reguard();
    }
}
