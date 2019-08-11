<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('producto');
            $table->integer('num_total_integrantes');
            // cada que un integrante del equipo registra el codigo compartido, este valor cambia
            // incrementandose
            $table->integer('conteo_registrados');
            $table->string('codigo_compartido');
            $table->integer('id_creador');
            // una vez que todos los integrantes del proyecto han cuminado su proceso de titulacion
            // este valor cambia a true
            $table->boolean('is_closed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proyectos');
    }
}
