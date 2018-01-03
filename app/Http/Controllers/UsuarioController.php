<?php

namespace App\Http\Controllers;

use App\Mail\ActualizarPassword;
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
                /* enviar correo con nueva password */
                Mail::to($usuario->email_usuario, $usuario->nombres_usuario)
                    ->send(new ActualizarPassword($usuario->nombres_usuario. ' ' .$usuario->apellidos_usuario, $request->get('nueva_pass')));

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


    public function guardarMisDatos(Request $request)
    {
        $response = [];

        $usuario = $this->_Usuarios->find(session()->get('id'));
        $usuario->rut_usuario = $request->get('rut');
        $usuario->nombres_usuario = $request->get('nombres');
        $usuario->apellidos_usuario = $request->get('apellidos');
        $usuario->email_usuario = $request->get('email');

        if($usuario->save()){
            $response['estado'] = true;
            $response['mensaje'] = 'Sus datos han sido actualizados';
        }else{
            $response['estado'] = false;
            $response['mensaje'] = 'Hubo un problema al actualizar sus datos. Intente nuevamente';
        }

        return response()->json($response);
    }

    public function editarAvatar()
    {
        return view('usuario.editar_avatar');
    }

    public function actualizarAvatar(Request $request)
    {
        $response = [];
        $validar_formato = $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($validar_formato  && $request->hasFile('avatar') and $request->file('avatar')->isValid()){
            $avatar = $_FILES['avatar'];
            $id_usuario = session()->get('id');
            $dir_usuario = 'storage/app/usuarios/' . $id_usuario;
            if(!is_dir($dir_usuario)){
                mkdir($dir_usuario, 0755, true);
            }

            $path = $request->file('avatar')->store('avatars/' . $id_usuario);
            $dir_avatar = 'storage/app/'.$path;
            /*$file = fopen($dir_usuario . '/' .$avatar['name'], 'w+b');
            fwrite($file, file_get_contents($avatar['tmp_name']));
            fclose($file);*/

            if(is_file($dir_avatar)){
                $usuario = $this->_Usuarios->find($id_usuario);
                $usuario->imagen_usuario = 'storage/app/'.$path;
                $usuario->save();
                $response['estado'] = true;
                $response['mensaje'] = 'Avatar actualizado';
                $response['avatar'] = url('storage/app/'.$path);
            }else{
                $response['estado'] = false;
                $response['mensaje'] = 'Problemas al actualizar avatar. Intente nuevamente';
            }
        }else{
            $response['estado'] = false;
            $response['mensaje'] = 'No se ha detectado ni un archivo o formato de archivo no válido';
        }

        return response()->json($response);
    }

    public function cargarPerfilActivo(Request $request)
    {
        $response = [
            'estado' => false,
            'mensaje' => 'Hubo un problema al cargar el perfil. Intente nuevamente'
        ];
        $perfil = $request->get('perfil');

        $usuario = $this->_Usuarios->find(session()->get('id'));
        if($usuario->perfiles()->updateExistingPivot($perfil, ['activo_pu' => 1])){
            $response['estado'] = true;
            $response['mensaje'] = 'Perfil cargado';
            $response['redirect'] = url('/Home/dashboard');
            session()->put('perfil', $perfil);
        }

        return response()->json($response);

    }

}
