<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTiposEventosProyectos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_eventos_proyectos', function (Blueprint $table) {
            $table->tinyInteger('id_tep')->unique();
            $table->string('nombre_tep',250);
            $table->primary('id_tep');
            //$table->timestamps();
        });

        $this->_populate();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('tipos_eventos_proyectos');
    }


    private function _populate(){
        $arr_estados_tareas = [
            ['id_tep' => 1, 'nombre_tep' => 'PROYECTO es creado'],
            ['id_tep' => 2, 'nombre_tep' => 'PROYECTO es finalizado'],
            ['id_tep' => 3, 'nombre_tep' => 'PROYECTO es pausado'],
            ['id_tep' => 4, 'nombre_tep' => 'LIDER DE PROYECTO es cambiado'],
            ['id_tep' => 5, 'nombre_tep' => 'PROYECTO es rechazado'],
        ];

        foreach($arr_estados_tareas as $data){
            \DB::table('tipos_eventos_proyectos')->insert($data);
        }
    }
}
