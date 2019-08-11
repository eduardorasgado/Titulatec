<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanEstudioEspecialidadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_estudio_especialidades', function (Blueprint $table) {
            // tabla que representa la relacion de los planes de estudio con la carrera o especialidad
            // y no directamente con alumnos

            // tabla con doble llave foranea, muchos a muchos
            $table->increments('id');

            // llaves foraneas
            $table->integer('id_plan_estudios')->unsigned();
            $table->integer('id_especialidad')->unsigned();

            $table->foreign('id_plan_estudios')
                ->references('id')
                ->on('plan_estudios');

            $table->foreign('id_especialidad')
                ->references('id')
                ->on('especialidades');
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
        Schema::dropIfExists('plan_estudio_especialidads');
    }
}
