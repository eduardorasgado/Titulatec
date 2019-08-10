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
        Schema::create('plan_estudio_especialidads', function (Blueprint $table) {
            // tabla con doble llave foranea, muchos a muchos
            $table->increments('id');

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
