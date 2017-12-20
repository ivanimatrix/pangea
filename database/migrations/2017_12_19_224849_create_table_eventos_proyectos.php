<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEventosProyectos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos_proyectos', function (Blueprint $table) {
            $table->bigIncrements('id_evp');
            $table->dateTime('fecha_evp');
            $table->unsignedBigInteger('usuario_fk_evp');
            $table->tinyInteger('tipo_fk_evp');
            $table->unsignedBigInteger('proyecto_fk_evp');

            //$table->primary('id_evp');

            $table->foreign('usuario_fk_evp')
                ->references('id_usuario')
                ->on('usuarios');

            $table->foreign('tipo_fk_evp')
                ->references('id_tep')
                ->on('tipos_eventos_proyectos');

            $table->foreign('proyecto_fk_evp')
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
        //Schema::dropIfExists('eventos_proyectos');
    }
}
