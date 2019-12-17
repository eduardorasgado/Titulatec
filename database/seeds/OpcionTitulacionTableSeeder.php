<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OpcionTitulacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('opcion_titulaciones')->insert([
            'clave' => 'I',
            'nombre' => 'TESIS PROFESIONAL',
            'estado' => true,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('opcion_titulaciones')->insert([
            'clave' => 'II',
            'nombre' => 'ELABORACIÓN DE TEXTOS O PROTOTIPOS DIDÁCTICOS',
            'estado' => true,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('opcion_titulaciones')->insert([
            'clave' => 'III',
            'nombre' => 'PARTICIPACIÓN DE UN PROYECTO O INVESTIGACIÓN',
            'estado' => true,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('opcion_titulaciones')->insert([
            'clave' => 'IV',
            'nombre' => 'DISEÑO O REDISEÑO DE EQUIPO, APARATO O MAQUINA',
            'estado' => true,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('opcion_titulaciones')->insert([
            'clave' => 'V',
            'nombre' => 'CURSO ESPECIAL DE TITULACIÓN',
            'estado' => true,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('opcion_titulaciones')->insert([
            'clave' => 'VI',
            'nombre' => 'EXAMEN GLOBAL POR AREAS DE CONOCIMIENTO',
            'estado' => true,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('opcion_titulaciones')->insert([
            'clave' => 'VII',
            'nombre' => 'MEMORIA POR EXPERIENCIA PROFESIONAL',
            'estado' => true,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('opcion_titulaciones')->insert([
            'clave' => 'VIII',
            'nombre' => 'ESCOLARIDAD POR PROMEDIO',
            'estado' => true,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('opcion_titulaciones')->insert([
            'clave' => 'IX',
            'nombre' => 'ESCOLARIDAD POR ESTUDIOS SUPERIORES',
            'estado' => true,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('opcion_titulaciones')->insert([
        'clave' => 'X',
        'nombre' => 'MEMORIA DE RESIDENCIA PROFESIONAL',
            'estado' => true,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('opcion_titulaciones')->insert([
            'clave' => 'XI',
            'nombre' => 'TITULACION INTEGRADA',
            'estado' => true,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('opcion_titulaciones')->insert([
            'clave' => 'XII',
            'nombre' => 'TITULACION INTEGRAL',
            'estado' => true,
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
