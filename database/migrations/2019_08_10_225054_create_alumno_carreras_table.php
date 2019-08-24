<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumnoCarrerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumno_carreras', function (Blueprint $table) {
            // tabla que representa los campos de especialidad y plan de estudio de un alumno dado
            $table->increments('id');

            // llaves foraneas de
            // alumnos
            // especialidad
            // plan de estudios

            $table->integer('id_alumno')->unsigned();
            $table->integer('id_especialidad')->unsigned()->nullable();
            $table->integer('id_plan_estudios')->unsigned()->nullable();

            $table->foreign('id_alumno')
                ->references('id')
                ->on('alumnos');

            $table->foreign('id_especialidad')
                ->references('id')
                ->on('especialidades');

            $table->foreign('id_plan_estudios')
                ->references('id')
                ->on('plan_estudios');

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
        Schema::dropIfExists('alumno_carreras');
    }
}
