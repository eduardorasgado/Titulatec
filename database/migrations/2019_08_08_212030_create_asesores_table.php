<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsesoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asesores', function (Blueprint $table) {
            $table->increments('id');

            $table->foreign('id_presidente')
                ->references('id')
                ->on('presidentes');

            $table->foreign('id_secretario')
                ->references('id')
                ->on('secretarios');

            $table->foreign('id_vocal')
                ->references('id')
                ->on('vocales');

            $table->foreign('id_vocal_suplente')
                ->references('id')
                ->on('vocal_suplentes');

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
        Schema::dropIfExists('asesores');
    }
}
