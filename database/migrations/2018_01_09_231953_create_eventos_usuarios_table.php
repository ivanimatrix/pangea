<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventosUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos_usuarios', function (Blueprint $table) {
            $table->bigIncrements('id_eu');
            $table->unsignedBigInteger('usuario_fk_eu');
            $table->dateTime('fecha_eu');
            $table->string('detalle_eu',1000);
            //$table->timestamps();

            //$table->primary('id_eu');
            $table->foreign('usuario_fk_eu')
                ->references('id_usuario')
                ->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('eventos_usuarios');
    }
}
