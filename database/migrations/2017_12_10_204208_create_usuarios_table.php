<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->bigIncrements('id_usuario')->unique();
            $table->string('rut_usuario', 10)->unique();
            $table->string('email_usuario', 50)->unique();
            $table->string('nombres_usuario', 50);
            $table->string('apellidos_usuario', 50);
            $table->string('pass_usuario', 250);
            $table->string('imagen_usuario', 250)->nullable();
            $table->date('registro_usuario');
            $table->tinyInteger('estado_usuario');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('usuarios');
    }
}
