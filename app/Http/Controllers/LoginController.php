<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Usuarios as Usuarios;

class LoginController extends Controller
{
    //

    public function index()
    {
        return view('login.login');
    }


    public function loginUsuario(Request $request)
    {

        $response = [
            'estado' => false,
            'mensaje' => '',
            'redirect' => ''
        ];

        $rut = $request->get('rut');
        $pass = $request->get('pass');
        $passHash = Hash::make($pass);

        $usuarios = new Usuarios();
        $usuario = $usuarios->where('rut_usuario', mb_strtolower($rut))->first();

        if($usuario and Hash::check($pass, $usuario->pass_usuario)){
            session()->put('id', $usuario->id_usuario);
            session()->put('nombres', $usuario->nombres_usuario);
            session()->put('apellidos', $usuario->apellidos_usuario);
            session()->put('avatar', $usuario->imagen_usuario);
            session()->put('perfil', $usuario->getPerfilActivo($usuario->id_usuario)->perfil_fk_pu);

            $response['estado'] = true;
            $response['redirect'] = url('/Home/dashboard');
        }else{
            $response['mensaje'] = 'Datos ingresados no correctos';
        }

        return response()->json($response);

    }

    /**
     * Cerrar sesion y volver al login
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logoutUsuario(Request $request)
    {
        $request->session()->flush();
        return redirect(url('/'));
    }
}
