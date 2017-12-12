<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePerfilesUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfiles_usuarios', function (Blueprint $table) {
            $table->tinyInteger('perfil_fk_pu');
            $table->unsignedBigInteger('usuario_fk_pu');
            $table->boolean('activo_pu');
            $table->primary(['perfil_fk_pu', 'usuario_fk_pu']);

            $table->foreign('usuario_fk_pu')
                  ->references('id_usuario')
                  ->on('usuarios')
                  ->onDelete('cascade');

            $table->foreign('perfil_fk_pu')
                  ->references('id_perfil')
                  ->on('perfiles')
                  ->onDelete('cascade');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('perfiles_usuarios');
    }
}
