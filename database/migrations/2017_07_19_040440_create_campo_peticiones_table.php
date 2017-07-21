<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampoPeticionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('CAMPOS_PETICIONES', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idPeticion')->nullable();
            $table->foreign('idPeticion')->references('id')->on('PETICIONES');
            $table->string('tabla');
            $table->string('campo');
            $table->string('tipo');
            $table->string('valorAnterior');
            $table->string('valorNuevo');
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
        //
        Schema::dropIfExists('CAMPOS_PETICIONES');
    }
}
