<?php

namespace App\Http\Controllers;

use App\Mail\SolicitarPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Usuarios as Usuarios;

class UsuarioController extends Controller
{

    /**
     * @var \App\Usuarios
     */
    protected $_Usuarios;


    public function __construct()
    {
        $this->_Usuarios = new Usuarios();
    }

    public function solicitarPassword(){
        return view('usuario.solicitar_password');
    }

    public function generarPassword(Request $request){
        
        $response = [
            'estado' => false,
            'mensaje' => 'No se ha generado nueva contraseña. Intente nuevamente'
        ];
        
        $pass = str_random(10);

        $email = trim($request->get('email'));

        if(filter_var($email, FILTER_VALIDATE_EMAIL) !== false){
            $usuarios = new Usuarios();

            $usuario = $usuarios->where('email_usuario', $email)->first();
            if($usuario){
                $pass_hash = Hash::make($pass);
                $usuario->pass_usuario = $pass_hash;
                if($usuario->save()){
                    /* enviar correo con nueva password */
                    Mail::to($usuario->email_usuario, $usuario->nombres_usuario)
                        ->send(new SolicitarPassword($usuario->nombres_usuario. ' ' .$usuario->apellidos_usuario, $pass));

                    $response['estado'] = true;
                    $response['mensaje'] = 'Se ha generado una solicitud de nueva contraseña, la cual ha sido enviada a su correo';
                }else{
                    $response['mensaje'] = 'No se ha podido generar nueva contraseña. Intente nuevamente';
                }

            }else{
                $response['mensaje'] = 'El correo ingresado no se encuentra registrado en el sistema';
            }

        }else{
            $response['mensaje'] = 'EMAIL no válido';
        }



        return response()->json($response);
    }


    public function miPerfil()
    {

        $usuario = $this->_Usuarios->find(session()->get('id'));

        return view('usuario.mi_perfil', ['usuario' => $usuario]);
    }

    public function actualizarMisDatos()
    {
        $usuario = $this->_Usuarios->find(session()->get('id'));

        return view('usuario.form-mis-datos', ['usuario' => $usuario]);
    }


    public function actualizarMiPassword()
    {
        return view('usuario.actualizar_password');
    }


    public function actualizarPassword(Request $request)
    {
        $response = [
            'estado' => false
        ];
        $usuario = $this->_Usuarios->find(session()->get('id'));

        if($usuario){
            $pass_hash = Hash::make($request->get('nueva_pass'));
            $usuario->pass_usuario = $pass_hash;
            if($usuario->save()){
                $response['estado'] = true;
                $response['mensaje'] = 'La contraseña ha sido actualizada';
            }else{
                $response['mensaje'] = 'No se ha podido actualizar nueva contraseña. Intente nuevamente';
            }
        }else{
            $response['mensaje'] = 'No se puede actualizar contraseña. Usuario no encontrado';
        }

        return response()->json($response);

    }


}
