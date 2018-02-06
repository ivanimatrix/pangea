<?php

namespace App\Http\Controllers;

use App\Mail\NuevoIntegranteProyecto;
use App\Perfiles;
use App\Proyectos;
use App\RolesProyectos;
use App\Usuarios;
use App\UsuariosProyectos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Mockery\Exception;

class UsuariosProyectoController extends Controller
{
    /** @var Proyectos */
    protected $_Proyectos;

    /** @var RolesProyectos */
    protected $_RolesProyectos;

    /** @var Perfiles */
    protected $_Perfiles;

    /** @var Usuarios */
    protected $_Usuarios;

    /** @var UsuariosProyectos */
    protected $_UsuariosProyectos;

    public function __construct()
    {
        $this->_Proyectos = new Proyectos();
        $this->_RolesProyectos = new RolesProyectos();
        $this->_Perfiles = new Perfiles();
        $this->_Usuarios = new Usuarios();
        $this->_UsuariosProyectos = new UsuariosProyectos();
    }

    public function formUsuarioProyecto($id_proyecto, $id_usuario = null)
    {
        $proyecto = $this->_Proyectos->find($id_proyecto);
        $roles = $proyecto->rolesProyecto;
        $data = [];
        $data['id_proyecto'] = $id_proyecto;
        $data['roles'] = $roles;
        if(is_null($id_usuario)){
            $colaborador = $this->_Perfiles->find(\App\Perfiles::COLABORADOR);
            $usuarios = $colaborador->usuarios;
        }else{
            //$usuarios = $this->_UsuariosProyectos->where(['usuario_fk_up' => $id_usuario, 'proyecto_fk_up' => $id_proyecto])->first();
            $usuarios = $this->_UsuariosProyectos->find($id_usuario);
            $data['edicion'] = true;
            $roles_usuario = $usuarios->roles;
            $arr_roles = [];
            foreach ($roles_usuario as $rol){
                $arr_roles[] = $rol->id_rp;
            }
            $data['roles_usuario'] = $arr_roles;

        }
        $data['usuarios'] = $usuarios;


        return view('proyectos.lider.form-usuarios-proyecto', $data);
    }


    public function guardarUsuario(Request $request)
    {
        $response = [];
        $estado = false;

        $usuarioProyecto = $this->_UsuariosProyectos->where(['usuario_fk_up' => $request->get('id_usuario'), 'proyecto_fk_up' => $request->get('proyecto')])->first();
        
        if(!$usuarioProyecto){
            $usuarioProyecto = new \App\UsuariosProyectos();
            $usuarioProyecto->usuario_fk_up = $request->get('integrante');
            $usuarioProyecto->proyecto_fk_up = $request->get('proyecto');
            $usuarioProyecto->fecha_registro_up = date('Y-m-d');

            if($usuarioProyecto->save()){
                $estado = true;
                $usuario = $this->_Usuarios->find($usuarioProyecto->usuario_fk_up);
                $proyecto = $this->_Proyectos->find($usuarioProyecto->proyecto_fk_up);
                /** enviar correo a nuevo integrante */
                Mail::to($usuario->email_usuario, $usuario->nombres_usuario)
                    ->send(new NuevoIntegranteProyecto($usuario->nombres_usuario. ' ' .$usuario->apellidos_usuario, $proyecto->nombre_proyecto));
            }
        }else{
            $estado = true;
        }

        if($estado){
            $usuarioProyecto->roles()->detach();
            $roles = $request->get('roles_usuario');
            foreach($roles as $rol){
                $usuarioProyecto->roles()->attach($rol);
            }

            $response['estado'] = $estado;
            $response['mensaje'] = 'Los datos han sido guardados';
        }else{
            $response['estado'] = false;
            $response['mensaje'] = 'Hubo un problema al guardar los datos. Intente nuevamente';
        }

        return response()->json($response);
    }


    public function listadoIntegrantes($id_proyecto)
    {
        $proyecto = $this->_Proyectos->find($id_proyecto);

        return view('proyectos.lider.listado-integrantes-proyecto', ['proyecto' => $proyecto]);
    }

}
