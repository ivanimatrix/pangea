<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnHorasDedicadasTareaTrazabilidad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tarea_trazabilidad', function (Blueprint $table) {
            $table->addColumn('float','horas_dedicadas_trazabilidad')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*Schema::table('tarea_trazabilidad', function (Blueprint $table) {
            //
        });*/
    }
}
