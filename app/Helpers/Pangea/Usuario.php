<?php

namespace App\Helpers\Pangea;

use Illuminate\Support\Facades\DB;

class Usuario {

    /**
     * Obtener nombres del usuario
     * @param $id
     * @return string
     */
    public static function getNombresUsuario($id)
    {
        $usuario = DB::table('usuarios')->where('id_usuario', $id)->first();

        return (isset($usuario->nombres_usuario) ? $usuario->nombres_usuario : '');
    }

    /**
     * Obtener imagen del usuario
     * @param $id
     * @return string
     */
    public static function getImagenUsuario($id)
    {
        $usuario = DB::table('usuarios')->where('id_usuario', $id)->first();

        return (isset($usuario->imagen_usuario) ? $usuario->imagen_usuario: '');
    }

    /**
     * Obtener apellidos de usuario
     *
     * @param int $id
     * @return string
     */
    public static function getApellidosUsuario($id)
    {
        $usuario = DB::table('usuarios')->where('id_usuario', $id)->first();

        return (isset($usuario->apellidos_usuario) ? $usuario->apellidos_usuario: '');
    }

    /**
     * Obtener email del usuario
     *
     * @param int $id
     * @return string
     */
    public static function getEmailUsuario($id)
    {
        $usuario = DB::table('users')->where('id_usuario', $id)->first();

        return (isset($usuario->email_usuario) ? $usuario->email_usuario: '');
    }

    /**
     * Obtener fecha de registro del usuario
     *
     * @param [type] $id
     * @return void
     */
    public static function getRegistroUsuario($id)
    {
        $usuario = DB::table('users')->where('id_usuario', $id)->first();

        return (isset($usuario->registro_usuario) ? $usuario->registro_usuario: '');
    }

    /**
     * Obtener perfil actual de usuario
     *
     * @param integer $id ID de perfil actual
     * @return string Nombre de perfil actual
     */
    public static function getPerfilActual($id)
    {
        $perfil = DB::table('perfiles')->where('id_perfil', $id)->first();

        return (isset($perfil->nombre_perfil) ? $perfil->nombre_perfil : '');
    }


    public static function getPerfiles($id)
    {
        return DB::table('perfiles_usuarios')->where('usuario_fk_pu', $id)->get();
    }
}