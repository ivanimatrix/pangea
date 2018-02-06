<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstadosTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estados_tareas', function (Blueprint $table) {
            $table->tinyInteger('id_et')->unique();
            $table->string('nombre_et', 50);
            $table->primary('id_et');
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
        //Schema::dropIfExists('estados_tareas');
    }

    private function _populate(){
        $arr_estados_tareas = [
            ['id_et' => 1, 'nombre_et' => 'CREADA'],
            ['id_et' => 2, 'nombre_et' => 'EN DESARROLLO'],
            ['id_et' => 3, 'nombre_et' => 'CERRADA'],
            ['id_et' => 4, 'nombre_et' => 'APROBADA'],
            ['id_et' => 5, 'nombre_et' => 'RECHAZADA'],
        ];

        foreach($arr_estados_tareas as $data){
            \DB::table('estados_tareas')->insert($data);
        }
    }
}
