<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsuariosProyectos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios_proyectos', function (Blueprint $table) {
            $table->unsignedBigInteger('usuario_fk_up');
            $table->unsignedBigInteger('proyecto_fk_up');
            $table->date('fecha_registro_up');
            $table->primary(['usuario_fk_up', 'proyecto_fk_up']);
            $table->foreign('usuario_fk_up')
                ->references('id_usuario')
                ->on('usuarios');

            $table->foreign('proyecto_fk_up')
                ->references('id_proyecto')
                ->on('proyectos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('usuarios_proyectos');
    }
}
