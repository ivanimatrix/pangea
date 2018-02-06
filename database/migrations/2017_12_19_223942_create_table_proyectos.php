<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProyectos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->bigIncrements('id_proyecto');
            $table->string('nombre_proyecto',500);
            $table->text('descripcion_proyecto');
            $table->dateTime('fecha_creacion_proyecto');
            $table->unsignedBigInteger('responsable_fk_proyecto')->nullable();
            $table->tinyInteger('estado_fk_proyecto');
            $table->boolean('hitos_proyecto');
            $table->date('fecha_inicio_proyecto');
            $table->date('fecha_termino_proyecto')->nullable();

            //$table->timestamps();

            $table->foreign('responsable_fk_proyecto')
                ->references('id_usuario')
                ->on('usuarios');

            $table->foreign('estado_fk_proyecto')
                ->references('id_ep')
                ->on('estados_proyectos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('proyectos');
    }
}
