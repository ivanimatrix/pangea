<?php

namespace App\Http\Controllers;

use App\HitosProyectos;
use App\Proyectos;
use Illuminate\Http\Request;

class HitosProyectoController extends Controller
{
    /** @var HitosProyectos */
    protected $_HitosProyecto;

    /** @var Proyectos */
    protected $_Proyectos;

    public function __construct()
    {
        $this->_Proyectos = new Proyectos();
        $this->_HitosProyecto = new HitosProyectos();
    }

    public function listadoHitos($id_proyecto)
    {
        $proyecto = $this->_Proyectos->find($id_proyecto);

        return view('proyectos.lider.listado-hitos-proyecto', ['proyecto' => $proyecto]);
    }


    public function formHito($id_proyecto, $id_hito = null)
    {
        $data = [];
        $data['id_proyecto'] = $id_proyecto;

        if (!is_null($id_hito)){
            $hito = $this->_HitosProyecto->find($id_hito);
            $data['hito'] = $hito;
        }

        return view('proyectos.lider.form-hito-proyecto', $data);
    }


    public function guardarHito(Request $request)
    {
        $response = [];

        if ($request->get('id_hito') > 0){
            $hito = $this->_HitosProyecto->find($request->get('id_hito'));
        } else {
            $hito = $this->_HitosProyecto;
        }

        $hito->nombre_hito = $request->get('nombre_hito');
        $hito->descripcion_hito = $request->get('descripcion_hito');
        $hito->proyecto_fk_hito = $request->get('id_proyecto');

        if ($hito->save()) {
            $response['estado'] = true;
            $response['mensaje'] = 'El hito ha sido guardado correctamente';
        }

        return response()->json($response);

    }


    public function tareasHito($id_hito)
    {
        $hito = $this->_HitosProyecto->find($id_hito);
        $tareas = $hito->tareas($id_hito);

        return view('proyectos.lider.listado-tareas-hito-proyecto', ['hito' => $hito, 'tareas' => $tareas]);
    }

}
