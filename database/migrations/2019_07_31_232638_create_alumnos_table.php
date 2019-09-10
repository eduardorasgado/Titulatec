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
            $table->increments('id');
            $table->string('numero_control')->nullable();
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->string('otherTECNM')->nullable();
            $table->string('estado')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('lugar_trabajo')->nullable();
            $table->string('puesto_trabajo')->nullable();
            $table->string('generacion')->nullable();
            $table->text('anexo')->nullable();
            $table->boolean('completed')->default(false);

            // llaves foraneas
            $table->integer('id_user')->unsigned();
            $table->integer('id_proyecto')->unsigned()->nullable();

            $table->foreign('id_user')->references('id')->on('users');
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
