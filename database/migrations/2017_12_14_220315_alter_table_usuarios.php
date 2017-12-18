<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::table('usuarios', function (Blueprint $table) {
            //
        });*/

        $data = [
            'imagen_usuario' => 'public/img/user_default.png'
        ];
        $user_id = 1;
        \DB::table('usuarios')->update($data, $user_id);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*Schema::table('usuarios', function (Blueprint $table) {
            //
        });*/
    }
}
