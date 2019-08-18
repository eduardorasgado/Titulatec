<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LibroTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        try {
            DB::table('libros')->insert([
                'numero_libro' => 1,
                'fecha_autorizacion' => new Carbon('2014-12-18'),
                'estado' => true,
                'created_at' => date("Y-m-d H:i:s")
            ]);
            DB::table('libros')->insert([
                'numero_libro' => 2,
                'fecha_autorizacion' => new Carbon('2016-02-25'),
                'estado' => true,
                'created_at' => date("Y-m-d H:i:s")
            ]);
            DB::table('libros')->insert([
                'numero_libro' => 3,
                'fecha_autorizacion' => new Carbon('2016-10-12'),
                'estado' => true,
                'created_at' => date("Y-m-d H:i:s")
            ]);
            DB::table('libros')->insert([
                'numero_libro' => 4,
                'fecha_autorizacion' => new Carbon('2017-01-12'),
                'estado' => true,
                'created_at' => date("Y-m-d H:i:s")
            ]);
            DB::table('libros')->insert([
                'numero_libro' => 5,
                'fecha_autorizacion' => new Carbon('2017-04-04'),
                'estado' => true,
                'created_at' => date("Y-m-d H:i:s")
            ]);
            DB::table('libros')->insert([
                'numero_libro' => 6,
                'fecha_autorizacion' => new Carbon('2017-08-15'),
                'estado' => true,
                'created_at' => date("Y-m-d H:i:s")
            ]);
            DB::table('libros')->insert([
                'numero_libro' => 7,
                'fecha_autorizacion' => new Carbon('2018-05-03'),
                'estado' => true,
                'created_at' => date("Y-m-d H:i:s")
            ]);
            DB::table('libros')->insert([
                'numero_libro' => 8,
                'fecha_autorizacion' => new Carbon('2018-09-26'),
                'estado' => true,
                'created_at' => date("Y-m-d H:i:s")
            ]);
            DB::table('libros')->insert([
                'numero_libro' => 9,
                'fecha_autorizacion' => new Carbon('2019-02-13'),
                'estado' => true,
                'created_at' => date("Y-m-d H:i:s")
            ]);
        } catch (Exception $e) {
            echo("Error de Carbon date");
        }
    }
}
