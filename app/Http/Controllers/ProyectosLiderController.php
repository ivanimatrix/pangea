<?php

namespace App\Http\Controllers;

use App\EventosUsuarios;
use App\Mail\CerrarProyecto;
use App\RolesProyectos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ProyectosLiderController extends Controller
{

    /** @var \App\Proyectos  */
    protected $_Proyectos;

    /** @var RolesProyectos */
    protected $_RolesProyectos;

    /**
     * @var EventosUsuarios
     */
    protected $_EventosUsuarios;

    public function __construct()
    {
        $this->_Proyectos = new \App\Proyectos();
        $this->_RolesProyectos = new RolesProyectos();
        $this->_EventosUsuarios = new EventosUsuarios();
    }


    public function misProyectos()
    {

        return view('proyectos.lider.mis-proyectos');
    }

    public function listadoMisProyectos()
    {
        $proyectos = $this->_Proyectos->where('responsable_fk_proyecto', session()->get('id'))->get();

        return view('proyectos.lider.grilla-mis-proyectos', ['proyectos' => $proyectos]);
    }

    public function formRolProyecto($id, $id_rol = null)
    {
        $data = [
            'id_proyecto' => $id,
            'id_rol' => 0,
            'rol' => null,
        ];

        if(!is_null($id_rol)){
            $rol = $this->_RolesProyectos->find($id_rol);
            $data['id_rol'] = $id_rol;
            $data['rol'] = $rol;
        }

        return view('proyectos.lider.form-rol-proyecto', $data);
    }

    public function guardarRolProyecto(Request $request)
    {
        $response = [
            'estado' => false,
            'mensaje' => 'Hubo un problema al guardar el Rol. Intente nuevamente',
        ];

        if($request->get('id_rol') > 0){
            $rol = $this->_RolesProyectos->find($request->get('id_rol'));
        }else{
            $rol = new RolesProyectos();
        }
        $rol->proyecto_fk_rp = $request->get('id_proyecto');
        $rol->nombre_rp = $request->get('nombre_rol');
        $rol->descripcion_rp = $request->get('descripcion_rol');

        if($rol->save()){
            $response['estado'] = true;
            $response['mensaje'] = 'El Rol ha sido guardado correctamente';
        }

        return response()->json($response);
    }


    public function cerrarProyecto(Request $request)
    {
        $response = array();

        $id_proyecto = $request->get('id_proyecto_cierre');
        $comentario_cierre = $request->get('comentario_cierre_proyecto');
        $proyecto = $this->_Proyectos->find($id_proyecto);
        $proyecto->estado_fk_proyecto = \App\EstadosProyectos::PROYECTO_CERRADO;
        if ($proyecto->save()) {
            $response['estado'] = true;
            $response['mensaje'] = 'El proyecto ha sido cerrado';

            $insertEventoUsuario = [
                'usuario_fk_eu' => session()->get('id'),
                'fecha_eu' => date('Y-m-d H:i:s'),
                'detalle_eu' => 'Se ha cerrado proyecto : ' . $proyecto->nombre_proyecto,
            ];
            $this->_EventosUsuarios->insert($insertEventoUsuario);

            $perfil = \App\Perfiles::find(\App\Perfiles::ADMINISTADOR_PROYECTOS);
            foreach ($perfil->usuarios as $usuario) {
                Mail::to($usuario->email_usuario, $usuario->nombres_usuario. ' '.$usuario->apellidos_usuario)
                    ->send(new CerrarProyecto($proyecto->nombre_proyecto, $comentario_cierre));
            }
        } else {
            $response['estado'] = false;
            $response['mensaje'] = 'Hubo un problema al cerrar el proyecto. Intente nuevamente';
        }

        return response()->json($response);
    }

    public function formCerrarProyecto($id_proyecto)
    {
        return view('proyectos.lider.cerrar-proyecto', ['id_proyecto' => $id_proyecto]);
    }

}
