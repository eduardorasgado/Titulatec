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
            $table->increments('id');
            // si el pdf se ha generado
            $table->binary('is_generated');
            $table->date('fecha_examen_aviso');
            // fecha en que se genera el acta
            $table->date('fecha_generacion');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->string('lugar_protocolo');

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
