<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        $guardar = false;
        if($request->get('id_usuario') > 0){
            $usuario = $this->_Usuarios->find($request->get('id_usuario'));
        }else{
            $usuario = $this->_Usuarios;
            $usuario->pass_usuario = \Hash::make($request->get('rut'));
            $usuario->imagen_usuario = 'public/img/user_default.png';
            $usuario->registro_usuario = date('Y-m-d');
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
            session()->put('perfil', $usuario->getPerfilActivo($usuario->id_usuario)->id_perfil);

            $response['estado'] = true;
            $response['redirect'] = url('/Home/dashboard');
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
