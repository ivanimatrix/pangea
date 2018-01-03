<?php

namespace App\Http\Controllers;

use App\Proyectos;
use App\RolesProyectos;
use Illuminate\Http\Request;

class RolesProyectoController extends Controller
{

    /** @var RolesProyectos */
    protected $_RolesProyectos;

    /** @var Proyectos */
    protected $_Proyectos;

    public function __construct()
    {
        $this->_RolesProyectos = new RolesProyectos();
        $this->_Proyectos = new Proyectos();
    }

    /**
     * @param $id_proyecto
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRolesProyecto($id_proyecto)
    {
        $response = ['roles' => array()];

        $proyecto = $this->_Proyectos->find($id_proyecto);
        if($proyecto->rolesProyecto){
            foreach ($proyecto->rolesProyecto as $rol) {
                $response['roles'][] = array(
                    'id' => $rol->id_rp,
                    'nombre' => $rol->nombre_rp,
                    'descripcion' => $rol->descripcion_rp,
                    'proyecto' => $rol->proyecto_fk_rp,
                );
            }
        }

        return response()->json($response);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function eliminarRol(Request $request)
    {
        $response = [
            'estado' => false,
            'mensaje' => 'Hubo un problema al eliminar el rol. Intente nuevamente',
        ];
        $rol = $this->_RolesProyectos->find($request->get('rol'));
        if($rol->delete()){
            $response['estado'] = true;
            $response['mensaje'] = 'Rol eliminado correctamente';
        }

        return response()->json($response);
    }
}
