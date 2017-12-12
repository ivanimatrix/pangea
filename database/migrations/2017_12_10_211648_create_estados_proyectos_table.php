<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstadosProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estados_proyectos', function (Blueprint $table) {
            $table->tinyInteger('id_ep')->unique();
            $table->string('nombre_ep', 100);
            $table->primary('id_ep');
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
        //Schema::dropIfExists('estados_proyectos');
    }


    private function _populate(){
        $arr_estados_proyectos = [
            ['id_ep' => 1, 'nombre_ep' => 'CREADO'],
            ['id_ep' => 2, 'nombre_ep' => 'FINALIZADO'],
            ['id_ep' => 3, 'nombre_ep' => 'CERRADO'],
            ['id_ep' => 4, 'nombre_ep' => 'PAUSADO'],
            ['id_ep' => 5, 'nombre_ep' => 'EN DESARROLLO']
        ];

        foreach($arr_estados_proyectos as $data){
            \DB::table('estados_proyectos')->insert($data);
        }
    }
}
