<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaestrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maestros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cedula_profesional')->unique();
            $table->string('especialidad_estudiada');
            // conteo de cuantas sinodalias lleva
            $table->integer('asesor_count');
            // llaves foraneas
            // users
            // academia
            $table->integer('id_user')->unsigned();
            $table->integer('id_academia')->unsigned();

            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_academia')->references('id')->on('academias');
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
        Schema::dropIfExists('maestros');
    }
}
