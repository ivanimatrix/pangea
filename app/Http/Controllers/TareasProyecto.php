<?php

namespace App\Http\Controllers;

use App\Helpers\Pangea;
use App\HitosProyectos;
use App\Perfiles;
use App\Proyectos;
use App\RolesProyectos;
use App\Tareas;
use App\UsuariosProyectos;
use App\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AsignacionTarea;
use App\Helpers\Pangea\Fechas;

class TareasProyecto extends Controller
{
    /** @var Tareas */
    protected $_Tareas;

    /** @var HitosProyectos */
    protected $_HitosProyectos;

    /** @var Proyectos */
    protected $_Proyectos;

    /** @var Perfiles */
    protected $_Perfiles;

    /** @var RolesProyectos */
    protected $_RolesProyectos;

    /** @var UsuariosProyectos */
    protected $_UsuariosProyectos;

    /**
     * Modelo \App\Usuarios
     *
     * @var \App\Usuarios
     */
    protected $_Usuarios;

    public function __construct()
    {
        $this->_Tareas = new Tareas();
        $this->_HitosProyectos = new HitosProyectos();
        $this->_Proyectos = new Proyectos();
        $this->_Perfiles = new Perfiles();
        $this->_RolesProyectos = new RolesProyectos();
        $this->_UsuariosProyectos = new UsuariosProyectos();
        $this->_Usuarios = new Usuarios();
    }

    public function formTarea($id_proyecto, $tipo_padre, $id_padre, $id_tarea = null)
    {
        if (is_null($id_tarea)) {
            $id_tarea = 0;
        }
        $proyecto = $this->_Proyectos->find($id_proyecto);

        $data = array(
            'proyecto' => $proyecto,
            'tipo_padre' => $tipo_padre,
            'id_padre' => $id_padre,
            'id_tarea' => $id_tarea
        );

        if(!is_null($id_tarea)){
            $tarea = $this->_Tareas->find($id_tarea);
            $data['tarea'] = $tarea;
        }

        return view('proyectos.lider.form-tarea-proyecto', $data);
    }

    public function guardarTarea(Request $request)
    {
        $response = [];

        $enviar_mail = false;
        if ($request->get('id_tarea') > 0) {
            $tarea = $this->_Tareas->find($request->get('id_tarea'));
        } else {
            $enviar_mail = true;
            $tarea = $this->_Tareas;
            $tarea->estado_fk_tarea = 1; /* TAREA CREADA */
        }
        $tarea->tipo_padre_fk_tarea = $request->get('tipo_padre');
        $tarea->padre_fk_tarea = $request->get('id_padre');
        $tarea->nombre_tarea = trim($request->get('nombre_tarea'));
        $tarea->responsable_fk_tarea = $request->get('responsable_tarea');
        $tarea->fecha_inicio_tarea = Pangea\Fechas::formatearBaseDatos($request->get('fecha_inicio_tarea'));
        $tarea->dias_tarea = $request->get('dias_tarea');
        $tarea->prioridad_tarea = $request->get('prioridad_tarea');
        $tarea->descripcion_tarea = $request->get('descripcion_tarea');

        if ($tarea->save()) {
            $response['estado'] = true;
            $response['mensaje'] = 'Tarea guardada correctamente';
            $response['tarea']['nombre'] = $tarea->nombre_tarea;
            $response['tarea']['responsable'] = $tarea->responsable->nombres_usuario. ' '. $tarea->responsable->apellidos_usuario;
            $response['tarea']['estado'] = $tarea->estado->nombre_et;
            $response['tarea']['fecha_inicio'] = Pangea\Fechas::formatearHtml($tarea->fecha_inicio_tarea);
            $response['tarea']['id'] = $tarea->id_tarea;

            if($tarea->hito->proyecto->estado_fk_proyecto == \App\EstadosProyectos::PROYECTO_CREADO) {
                $proyecto = $this->_Proyectos->find($tarea->hito->proyecto->id_proyecto);
                $proyecto->estado_fk_proyecto = \App\EstadosProyectos::PROYECTO_EN_DESARROLLO;
                $proyecto->save();
            }

            if ($enviar_mail) {
                /* enviar correo con tarea asignada */
                $usuario = $this->_Usuarios->find($tarea->responsable_fk_tarea);
                Mail::to($usuario->email_usuario, $usuario->nombres_usuario)
                    ->send(new AsignacionTarea($usuario->nombres_usuario . ' ' . $usuario->apellidos_usuario, $request->get('nombre_proyecto'), $tarea->nombre_tarea, Fechas::formatearHtml($tarea->fecha_inicio_tarea), $tarea->dias_tarea, $tarea->prioridad_tarea ));
            }
        } else {
            $response['estado'] = false;
            $response['mensaje'] = 'Hubo un problema al guardar la tarea. Intente nuevamente';
        }

        return response()->json($response);
    }


    public function listadoTareas(Request $request)
    {
        $response = array();

        $prioridad = $request->get('prioridad');
        $id_proyecto = $request->get('proyecto');

        $proyecto = $this->_Proyectos->find($id_proyecto);
        if (count($proyecto->hitosProyecto) > 0) {
            foreach ($proyecto->hitosProyecto as $hito) {
                $tareas = $hito->tareas;
                if (count($tareas) > 0) {
                    foreach ($tareas as $tarea) {
                        if ($tarea->prioridad_tarea == $prioridad) {
                            $endDate = date('Y-m-d', strtotime($tarea->fecha_inicio_tarea . " +" . $tarea->dias_tarea . " days"));
                            $response[] = [
                                'title' => $tarea->nombre_tarea,
                                'start' => $tarea->fecha_inicio_tarea,
                                'end' => $endDate
                            ];
                        }
                        
                    }
                }
            }
        }
        
        return response()->json($response);
    }


    public function borrarTareaProyecto(Request $request)
    {
        $tarea = $this->_Tareas->find($request->get('tarea'));

        if($tarea->delete()) {
            $response['correcto'] = true;
            $response['mensaje'] = 'Tarea borrada correctamente';
        }else{
            $response['correcto'] = false;
            $response['mensaje'] = 'Hubo un problema al borrar la tarea. Intente nuevamente';
        }

        return response()->json($response);
    }


}
