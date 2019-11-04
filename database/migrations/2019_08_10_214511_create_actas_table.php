<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actas', function (Blueprint $table) {
            // TODO: REMIGRAR
            $table->increments('id');
            // si el pdf se ha generado
            $table->boolean('is_generated');
            $table->string('fecha_examen_aviso');
            // fecha en que se genera el acta, se setea en DocumentacionController
            $table->string('fecha_generacion');
            $table->string('hora_inicio');
            $table->string('hora_fin')->nullable();
            $table->string('lugar_protocolo');
            $table->integer('foja')->nullable();
            // llaves foraneas
            $table->integer('id_proceso_titulacion')->unsigned();
            $table->integer('id_libro')->unsigned()->nullable();

            $table->foreign('id_proceso_titulacion')->references('id')->on('proceso_titulaciones');
            $table->foreign('id_libro')->references('id')->on('libros');
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
        Schema::dropIfExists('actas');
    }
}
