<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanDeEstudiosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('plan_estudios')->insert([
            'clave' => 'ARQ-2010-204',
            'is_actual' => true,
            'estado' => true,
            'id_especialidad' => 1, // arquitectura
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('plan_estudios')->insert([
            'clave' => 'ARQU-1993-287',
            'is_actual' => false,
            'estado' => true,
            'id_especialidad' => 1, // arquitectura
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('plan_estudios')->insert([
            'clave' => 'ARQU-2004-287',
            'is_actual' => false,
            'estado' => true,
            'id_especialidad' => 1, // arquitectura
            'created_at' => date("Y-m-d H:i:s")
        ]);


        DB::table('plan_estudios')->insert([
            'clave' => 'COPU-2010-205',
            'is_actual' => true,
            'estado' => true,
            'id_especialidad' => 2, // contador publico
            'created_at' => date("Y-m-d H:i:s")
        ]);


        DB::table('plan_estudios')->insert([
            'clave' => 'ICIV-1993-289',
            'is_actual' => false,
            'estado' => true,
            'id_especialidad' => 3, // ing civil
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('plan_estudios')->insert([
            'clave' => 'ICIV-2005-289',
            'is_actual' => false,
            'estado' => true,
            'id_especialidad' => 3, // ing civil
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('plan_estudios')->insert([
            'clave' => 'ICIV-2010-208',
            'is_actual' => true,
            'estado' => true,
            'id_especialidad' => 3, // ing civil
            'created_at' => date("Y-m-d H:i:s")
        ]);


        DB::table('plan_estudios')->insert([
            'clave' => 'IELEC-1993-290',
            'is_actual' => false,
            'estado' => true,
            'id_especialidad' => 4, // ing electrica
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('plan_estudios')->insert([
            'clave' => 'IELEC-2005-290',
            'is_actual' => false,
            'estado' => true,
            'id_especialidad' => 4, // ing electrica
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('plan_estudios')->insert([
            'clave' => 'IELEC-2010-209',
            'is_actual' => true,
            'estado' => true,
            'id_especialidad' => 4, // ing electrica
            'created_at' => date("Y-m-d H:i:s")
        ]);


        DB::table('plan_estudios')->insert([
            'clave' => 'IEME-1993-291',
            'is_actual' => false,
            'estado' => true,
            'id_especialidad' => 5, // ing electromecanica
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('plan_estudios')->insert([
            'clave' => 'IEME-2005-291',
            'is_actual' => false,
            'estado' => true,
            'id_especialidad' => 5, // ing electromecanica
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('plan_estudios')->insert([
            'clave' => 'IEME-2010-210',
            'is_actual' => true,
            'estado' => true,
            'id_especialidad' => 5, // ing electromecanica
            'created_at' => date("Y-m-d H:i:s")
        ]);


        DB::table('plan_estudios')->insert([
            'clave' => 'IGEM-2009-201',
            'is_actual' => true,
            'estado' => true,
            'id_especialidad' => 6, // ing en gestion empresarial
            'created_at' => date("Y-m-d H:i:s")
        ]);


        DB::table('plan_estudios')->insert([
            'clave' => 'IIND-1993-297',
            'is_actual' => false,
            'estado' => true,
            'id_especialidad' => 7, // ing industrial
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('plan_estudios')->insert([
            'clave' => 'IIND-2004-297',
            'is_actual' => false,
            'estado' => true,
            'id_especialidad' => 7, // ing industrial
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('plan_estudios')->insert([
            'clave' => 'IIND-2010-227',
            'is_actual' => true,
            'estado' => true,
            'id_especialidad' => 7, // ing industrial
            'created_at' => date("Y-m-d H:i:s")
        ]);


        DB::table('plan_estudios')->insert([
            'clave' => 'IINF-2010-220',
            'is_actual' => true,
            'estado' => true,
            'id_especialidad' => 8, // ing informatica
            'created_at' => date("Y-m-d H:i:s")
        ]);


        DB::table('plan_estudios')->insert([
            'clave' => 'IMCT-2010-229',
            'is_actual' => true,
            'estado' => true,
            'id_especialidad' => 9, // ing mecatronica
            'created_at' => date("Y-m-d H:i:s")
        ]);


        DB::table('plan_estudios')->insert([
            'clave' => 'IMEC-1993-298',
            'is_actual' => false,
            'estado' => true,
            'id_especialidad' => 10, // ing mecanica
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('plan_estudios')->insert([
            'clave' => 'IMEC-2005-298',
            'is_actual' => false,
            'estado' => true,
            'id_especialidad' => 10, // ing mecanica
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('plan_estudios')->insert([
            'clave' => 'IMEC-2010-228',
            'is_actual' => true,
            'estado' => true,
            'id_especialidad' => 10, // ing mecanica
            'created_at' => date("Y-m-d H:i:s")
        ]);


        DB::table('plan_estudios')->insert([
            'clave' => 'ISIC-1993-296',
            'is_actual' => false,
            'estado' => true,
            'id_especialidad' => 11, // ing en sistemas
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('plan_estudios')->insert([
            'clave' => 'ISIC-2004-296',
            'is_actual' => false,
            'estado' => true,
            'id_especialidad' => 11, // ing en sistemas
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('plan_estudios')->insert([
            'clave' => 'ISIC-2010-224',
            'is_actual' => true,
            'estado' => true,
            'id_especialidad' => 11, // ing en sistemas
            'created_at' => date("Y-m-d H:i:s")
        ]);


        DB::table('plan_estudios')->insert([
            'clave' => 'LCON-1993-302',
            'is_actual' => false,
            'estado' => true,
            'id_especialidad' => 12, // lic en contaduria
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('plan_estudios')->insert([
            'clave' => 'LCON-2004-302',
            'is_actual' => false,
            'estado' => true,
            'id_especialidad' => 12, // lic en contaduria
            'created_at' => date("Y-m-d H:i:s")
        ]);


        DB::table('plan_estudios')->insert([
            'clave' => 'LINF-1993-303',
            'is_actual' => false,
            'estado' => true,
            'id_especialidad' => 13, // lic en informatica
            'created_at' => date("Y-m-d H:i:s")
        ]);

    }
}
