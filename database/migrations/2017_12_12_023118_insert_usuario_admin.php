<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertUsuarioAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        DB::table('usuarios')->insert([
            'id_usuario' => 1,
            'rut_usuario' => '1-9',
            'nombres_usuario' => 'Administrador',
            'apellidos_usuario' => 'General',
            'email_usuario' => 'admin.general@pangea.cl',
            'pass_usuario' => Hash::make('demo'),
            'imagen_usuario' => '',
            'registro_usuario' => date('Y-m-d')
        ]);

        DB::table('perfiles_usuarios')->insert([
            'perfil_fk_pu' => 1,
            'usuario_fk_pu' => 1,
            'activo_pu' => 1
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /* Schema::table('usuarios', function (Blueprint $table) {
        
        }); */
    }
}
