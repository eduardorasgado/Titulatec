<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcesoTitulacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proceso_titulaciones', function (Blueprint $table) {
            $table->increments('id');
            // representan el estado del proceso de la titulacion
            $table->binary('datos_generales');
            $table->binary('solicitud_titulacion');
            $table->binary('memorandum');
            $table->binary('registro_proyecto');
            $table->binary('avisos');
            $table->binary('is_proceso_finished');
            // foraneas:
            // opcion titulacion
            // asesores
            // acta
            $table->foreign('id_opcion_titulacion')->references('id')->on('opcion_titulaciones');
            $table->foreign('id_acta')->references('id')->on('actas');

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
        Schema::dropIfExists('proceso_titulacions');
    }
}
