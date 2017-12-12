<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuarios as Usuarios;

class UsuarioController extends Controller
{
    
    public function solicitarPassword(){
        return view('usuario.solicitar_password');
    }

    public function generarPassword(){
        
        $response = [
            'estado' => false,
            'mensaje' => 'No se ha generado nueva contraseña. Intente nuevamente'
        ];
        
        $pass = '';

        $pass_hash = Hash::make($pass);

        return response()->json($response);
    }

}
