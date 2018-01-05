<?php

namespace App\Http\Controllers;

use App\Perfiles;
use App\Proyectos;
use App\RolesProyectos;
use App\Usuarios;
use App\UsuariosProyectos;
use Illuminate\Http\Request;
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

    public function formUsuarioProyecto($id_proyecto, $id = null)
    {
        $proyecto = $this->_Proyectos->find($id_proyecto);
        $roles = $proyecto->rolesProyecto;

        $colaborador = $this->_Perfiles->find(\App\Perfiles::COLABORADOR);
        $usuarios = $colaborador->usuarios;

        return view('proyectos.lider.form-usuarios-proyecto', ['roles' => $roles, 'usuarios' => $usuarios, 'id_proyecto' => $id_proyecto]);
    }


    public function guardarUsuario(Request $request)
    {
        $response = [];
        $estado = false;

        $usuarioProyecto = $this->_UsuariosProyectos->where(['usuario_fk_up' => $request->get('id_usuario'),'proyecto_fk_up' =>$request->get('proyecto')])->first();

        if(!$usuarioProyecto){
            $usuarioProyecto = new \App\UsuariosProyectos();
            $usuarioProyecto->usuario_fk_up = $request->get('id_usuario');
            $usuarioProyecto->proyecto_fk_up = $request->get('proyecto');
            $usuarioProyecto->fecha_registro_up = date('Y-m-d');

            if($usuarioProyecto->save()){
                $estado = true;
            }
        }else{
            $estado = true;
        }

        if($estado){
            $usuarioProyecto->roles()->detach();
            $roles = $request->get('roles_usuario');
            foreach($roles as $rol){
                $usuarioProyecto->roles()->attach($rol,['usuario_fk_ur' => $usuarioProyecto->usuario_fk_up]);
            }

            $response['estado'] = $estado;
            $response['mensaje'] = 'Los datos han sido guardados';
        }else{
            $response['estado'] = false;
            $response['mensaje'] = 'Hubo un problema al guardar los datos. Intente nuevamente';
        }

        return response()->json($response);
    }

}
