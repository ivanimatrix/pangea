<?php

namespace App\Http\Controllers;

use App\Mail\RegistrarUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Usuarios;

class MantenedorUsuariosController extends Controller
{

    /**
     * @var \App\Usuarios
     */
    private $_Usuarios;

    /**
     * @var \App\Perfiles
     */
    private $_Pefiles;

    public function __construct()
    {
        $this->_Usuarios = new \App\Usuarios;
    }


    public function index()
    {
        return view('mantenedores.usuarios.index');
    }

    public function listado()
    {
        $usuarios = $this->_Usuarios->all();

        return view('mantenedores.usuarios.grilla', ['usuarios' => $usuarios]);
    }


    public function formUsuario($id_usuario = null){
        $usuario = null;
        if($this->_Usuarios->find($id_usuario)){
            $usuario = $this->_Usuarios->find($id_usuario);
            $arr_pu = [];
            foreach($usuario->perfiles as $pu){
                $arr_pu[] = $pu->id_perfil;
            }
            $usuario->pu = $arr_pu;
        }

        $this->_Pefiles = new \App\Perfiles();

        return view(
            'mantenedores.usuarios.form',
            [
                'usuario' => $usuario,
                'perfiles' => $this->_Pefiles->all()
            ]);
    }


    public function guardarUsuario(Request $request){

        $response = [
            'estado' => false,
            'mensaje' => 'Hubo un problema al guardar los datos. Intente nuevamente'
        ];

        $enviar_mail = false;
        $guardar = false;
        if($request->get('id_usuario') > 0){
            $usuario = $this->_Usuarios->find($request->get('id_usuario'));
        }else{
            $pass = str_random(10);
            $usuario = $this->_Usuarios;
            $usuario->pass_usuario = \Hash::make($pass);
            $usuario->imagen_usuario = 'public/img/user_default.png';
            $usuario->registro_usuario = date('Y-m-d');
            $enviar_mail = true;
        }
        $usuario->rut_usuario = $request->get('rut');
        $usuario->nombres_usuario = $request->get('nombres');
        $usuario->apellidos_usuario = $request->get('apellidos');
        $usuario->email_usuario = $request->get('email');
        if($usuario->save()){
            $usuario->perfiles()->detach();
            $perfiles = $request->get('perfiles');
            foreach($perfiles as $perfil){
                $usuario->perfiles()->attach($perfil, ['activo_pu' => 0]);
            }

            if($enviar_mail){
                /* enviar correo con nueva password */
                Mail::to($usuario->email_usuario, $usuario->nombres_usuario)
                    ->send(new RegistrarUsuario($usuario->nombres_usuario. ' ' .$usuario->apellidos_usuario, $usuario->rut_usuario, $pass));
            }

            $response['estado'] = true;
            $response['mensaje'] = 'Datos guardados correctamente';
        }

        return response()->json($response);
    }


    public function cargarPerfilUsuario(Request $request)
    {
        $response = [];
        $id_usuario = $request->get('usuario');

        $usuario = $this->_Usuarios->find($id_usuario);

        if($usuario){
            session()->put('id_respaldo', session()->get('id'));
            session()->put('id', $usuario->id_usuario);
            session()->put('nombres', $usuario->nombres_usuario);
            session()->put('apellidos', $usuario->apellidos_usuario);
            session()->put('avatar', $usuario->imagen_usuario);
            if($usuario->getPerfilActivo($usuario->id_usuario)){
                $response['redirect'] = url('/Home/dashboard');
                session()->put('perfil', $usuario->getPerfilActivo($usuario->id_usuario)->perfil_fk_pu);
            }else{
                $response['redirect'] = url('/Home/cargarPerfil');
            }

            $response['estado'] = true;
            
        }else{
            $response['estado'] = false;
            $response['mensaje'] = 'Usuario no encontrado';
        }

        return response()->json($response);
    }

    public function cerrarPerfilUsuario()
    {
        $response = [];

        $usuario = $this->_Usuarios->find(session()->get('id_respaldo'));

        if($usuario){
            session()->forget('id_respaldo');
            session()->put('id', $usuario->id_usuario);
            session()->put('nombres', $usuario->nombres_usuario);
            session()->put('apellidos', $usuario->apellidos_usuario);
            session()->put('avatar', $usuario->imagen_usuario);
            session()->put('perfil', $usuario->getPerfilActivo($usuario->id_usuario)->perfil_fk_pu);

            $response['estado'] = true;
            $response['redirect'] = url('/MantenedorUsuarios/index');
        }else{
            $response['estado'] = false;
            $response['mensaje'] = 'No se ha podido reestablecer su sesión';
        }

        return response()->json($response);
    }

}
