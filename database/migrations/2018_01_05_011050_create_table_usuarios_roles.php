<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsuariosRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios_roles', function (Blueprint $table) {
            $table->unsignedInteger('rol_fk_ur');
            $table->unsignedBigInteger('usuario_fk_ur');

            $table->primary(['rol_fk_ur', 'usuario_fk_ur']);

            $table->foreign('rol_fk_ur')
                ->references('id_rp')
                ->on('roles_proyectos');

            $table->foreign('usuario_fk_ur')
                ->references('usuario_fk_up')
                ->on('usuarios_proyectos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('usuarios_roles');
    }
}
