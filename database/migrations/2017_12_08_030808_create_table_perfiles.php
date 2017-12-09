<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePerfiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfiles', function (Blueprint $table) {
            $table->integer('id_perfil')->unique();
            $table->string('nombre_perfil', 50);
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
        //
    }

    private function _populate(){
        $arr_perfiles = [
            ['id_perfil' => 1, 'nombre_perfil' => 'ADMINISTRADOR SISTEMA'],
            ['id_perfil' => 2, 'nombre_perfil' => 'ADMINISTRADOR PROYECTOS'],
            ['id_perfil' => 3, 'nombre_perfil' => 'LÍDER DE PROYECTO'],
            ['id_perfil' => 4, 'nombre_perfil' => 'COLABORADOR']
        ];

        foreach($arr_perfiles as $data){
            \DB::table('perfiles')->insert($data);
        }
        
    }
}
