<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->bigIncrements('id_tarea');
            $table->string('nombre_tarea', 500);
            $table->unsignedBigInteger('responsable_fk_tarea');
            $table->tinyInteger('estado_fk_tarea');
            $table->tinyInteger('tipo_padre_fk_tarea');
            $table->tinyInteger('prioridad_tarea');
            $table->date('fecha_inicio_tarea');
            $table->tinyInteger('dias_tarea');
            $table->date('fecha_termino_tarea')->nullable();
            $table->unsignedBigInteger('padre_fk_tarea');
            $table->text('descripcion_tarea')->nullable();

            $table->foreign('responsable_fk_tarea')
                ->references('id_usuario')
                ->on('usuarios');

            $table->foreign('estado_fk_tarea')
                ->references('id_et')
                ->on('estados_tareas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('tareas');
    }
}
