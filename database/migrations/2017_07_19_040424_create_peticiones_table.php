<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeticionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PETICIONES', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idTipoPeticion')->nullable();
            $table->foreign('idTipoPeticion')->references('id')->on('TIPOS_PETICION');
            $table->string('idUsuario')->nullable();
            //            $table->foreign('idUsuario')->references('Nombre')->on('USUARIO');
            $table->integer('Codigo')->nullable();
            $table->integer('Empresa')->nullable();
//            $table
//                ->foreign(array('Codigo', 'Empresa'))
//                ->references(array('Codigo', 'Empresa'))
//                ->on('BODEGA');
            $table->date('fechaCreacion');
            $table->integer('estado');
            $table->string('idUsuarioAutorizador')->nullable();
            //            $table->foreign('idUsuarioAutorizador')->references('Nombre')->on('USUARIO');
            $table->date('fechaAtencion')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('PETICIONES');
    }
}
