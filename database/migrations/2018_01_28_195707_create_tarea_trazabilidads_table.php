<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTareaTrazabilidadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarea_trazabilidad', function (Blueprint $table) {
            $table->bigIncrements('id_trazabilidad');
            $table->datetime('fecha_trazabilidad');
            $table->text('descripcion_trazabilidad');
            $table->unsignedBigInteger('usuario_fk_trazabilidad');
            $table->unsignedBigInteger('tarea_fk_trazabilidad');

            $table->foreign('usuario_fk_trazabilidad')
                ->references('id_usuario')
                ->on('usuarios');

            $table->foreign('tarea_fk_trazabilidad')
                ->references('id_tarea')
                ->on('tareas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('tarea_trazabilidads');
    }
}
