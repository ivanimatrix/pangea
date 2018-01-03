<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles_proyectos', function (Blueprint $table) {
            $table->increments('id_rp');
            $table->unsignedBigInteger('proyecto_fk_rp');
            $table->string('nombre_rp', 100);
            $table->text('descripcion_rp');

            $table->foreign('proyecto_fk_rp')
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
        //Schema::dropIfExists('roles_proyectos');
    }
}
