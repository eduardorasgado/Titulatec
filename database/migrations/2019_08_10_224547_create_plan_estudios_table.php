<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanEstudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_estudios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('clave')->unique();
            // es de utilidad para mostrar formato actual o pasado
            $table->boolean('is_actual');
            $table->boolean('estado');
            $table->integer('id_especialidad')->unsigned();;

            // llaves foraneas
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
        Schema::dropIfExists('plan_estudios');
    }
}
