<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableComentariosProyectos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentarios_proyectos', function (Blueprint $table) {
            $table->bigIncrements('id_comentarioproy');
            $table->unsignedBigInteger('proyecto_fk_comentarioproy');
            $table->dateTime('fecha_comentarioproy');
            $table->unsignedBigInteger('usuario_fk_comentarioproy');
            $table->text('texto_comentarioproy');
            $table->foreign('proyecto_fk_comentarioproy')
                ->references('id_proyecto')
                ->on('proyectos');
            $table->foreign('usuario_fk_comentarioproy')
                ->references('id_usuario')
                ->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('comentarios_proyectos');
    }
}
