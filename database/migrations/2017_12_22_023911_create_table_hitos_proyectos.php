<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableHitosProyectos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hitos_proyectos', function (Blueprint $table) {
            $table->bigIncrements('id_hito');
            $table->string('nombre_hito',1000);
            $table->unsignedBigInteger('proyecto_fk_hito');
            $table->text('descripcion_hito')->nullable();
            //$table->timestamps();

            $table->foreign('proyecto_fk_hito')
                ->references('id_proyecto')
                ->on('proyectos')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('hitos_proyectos');
    }
}
