<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('otherTECNM')->nullable();
            $table->string('estado');
            $table->string('ciudad');
            $table->string('lugar_trabajo')->nullable();
            $table->string('puesto_trabajo')->nullable();
            $table->string('generacion');
            $table->text('anexo');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_proyecto')->references('id')->on('proceso_titulaciones');
            $table->foreign('id_proyecto')->references('id')->on('proyectos');
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
        Schema::dropIfExists('alumnos');
    }
}
