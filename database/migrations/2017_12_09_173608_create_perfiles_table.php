<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfiles', function (Blueprint $table) {
            $table->tinyInteger('id_perfil')->unique();
            $table->string('nombre_perfil', 50);
            //$table->timestamps();
            $table->primary('id_perfil');
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
        //Schema::dropIfExists('perfiles');
    }


    private function _populate(){
        $arr_perfiles = [
            ['id_perfil' => 1, 'nombre_perfil' => 'ADMINISTRADOR GENERAL'],
            ['id_perfil' => 2, 'nombre_perfil' => 'ADMINISTRADOR PROYECTOS'],
            ['id_perfil' => 3, 'nombre_perfil' => 'LIDER'],
            ['id_perfil' => 4, 'nombre_perfil' => 'COLABORADOR']
        ];

        foreach($arr_perfiles as $data){
            \DB::table('perfiles')->insert($data);
        }
    }
}
