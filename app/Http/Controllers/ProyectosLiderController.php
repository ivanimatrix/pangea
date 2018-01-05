<?php

namespace App\Http\Controllers;

use App\RolesProyectos;
use Illuminate\Http\Request;

class ProyectosLiderController extends Controller
{

    /** @var \App\Proyectos  */
    protected $_Proyectos;

    /** @var RolesProyectos */
    protected $_RolesProyectos;

    public function __construct()
    {
        $this->_Proyectos = new \App\Proyectos();
        $this->_RolesProyectos = new RolesProyectos();
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



}
