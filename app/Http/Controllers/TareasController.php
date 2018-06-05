<?php

namespace App\Http\Controllers;

use App\EventosUsuarios;
use App\Mail\RechazarTarea;
use Illuminate\Support\Facades\Mail;
use App\Mail\CerrarTarea;
use App\TareaTrazabilidad;
use Illuminate\Http\Request;
use App\Tareas;
use App\EstadosTareas;

class TareasController extends Controller
{
    /**
     * Modelo \App\Tareas
     *
     * @var \App\Tareas
     */
    protected $_Tareas;

    /**
     * Modelo \App\EstadosTareas
     *
     * @var \App\EstadosTareas
     */
    protected $_EstadosTareas;

    /**
     * @var \App\TareaTrazabilidad
     */
    protected $_TareaTrazabilidad;

    /**
     * @var \App\EventosUsuarios
     */
    protected $_EventosUsuarios;

    public function __construct()
    {
        $this->_Tareas = new Tareas();
        $this->_EstadosTareas = new EstadosTareas();
        $this->_TareaTrazabilidad = new TareaTrazabilidad();
        $this->_EventosUsuarios = new EventosUsuarios();
    }

    public function misTareas()
    {

        return view('tareas.mis-tareas');
    }


    public function listarMisTareas(Request $request)
    {   
        $estado = $request->get('estado');
        $estado_tarea = 0;
        switch ($estado) {
            case 'creadas' : $estado_tarea = \App\EstadosTareas::TAREA_CREADA;
                break;
            case 'en_desarrollo' : 
                $estado_tarea = \App\EstadosTareas::TAREA_EN_DESARROLLO;
                break;
            case 'cerradas':
                $estado_tarea = \App\EstadosTareas::TAREA_CERRADA;
                break;
            case 'aprobadas':
                $estado_tarea = \App\EstadosTareas::TAREA_APROBADA;
                break;
            case 'rechazadas':
                $estado_tarea = \App\EstadosTareas::TAREA_RECHAZADA;
                break;
        }

        $tareas = $this->_Tareas->where(['responsable_fk_tarea' => session()->get('id'), 'estado_fk_tarea' => $estado_tarea])->get();
        $data = [
            'tareas' => $tareas,
            'grilla' => $estado,
        ];

        return view('tareas.grilla-tareas', $data);
    }

    public function formTarea($id_tarea)
    {
        $tarea = $this->_Tareas->find($id_tarea);

        $data = [
            'tarea' => $tarea
        ];
        
        return view('tareas.form-tarea', $data);
    }


    public function trazabilidadTarea(Request $request)
    {
        $id_tarea = $request->get('tarea');

        $total_horas_dedicadas = 0;
        $tarea_trazabilidad = $this->_TareaTrazabilidad->where(['tarea_fk_trazabilidad' => $id_tarea])->get();
        if( $tarea_trazabilidad) {
            foreach ($tarea_trazabilidad as $item) {
                $total_horas_dedicadas += $item->horas_dedicadas_trazabilidad;
            }
        }

        return view('tareas.grilla-trazabilidad-tarea', ['listado' => $tarea_trazabilidad, 'total_horas_dedicadas' => $total_horas_dedicadas]);
    }


    public function registrarAvance(Request $request)
    {
        $response = array();

        $id_tarea = $request->get('id_tarea_avance');
        $texto = $request->get('texto_avance');
        $horas_dedicadas = null;
        if($request->get('horas_dedicadas')){
            $horas_dedicadas = $request->get('horas_dedicadas');
        }

        $tarea = $this->_Tareas->find($id_tarea);
        $tarea_trazabilidad = $this->_TareaTrazabilidad;
        $tarea_trazabilidad->fecha_trazabilidad = date('Y-m-d H:i:s');
        $tarea_trazabilidad->usuario_fk_trazabilidad = session()->get('id');
        $tarea_trazabilidad->descripcion_trazabilidad = nl2br($texto);
        $tarea_trazabilidad->tarea_fk_trazabilidad = $id_tarea;
        $tarea_trazabilidad->horas_dedicadas_trazabilidad = $horas_dedicadas;

        if($tarea_trazabilidad->save()) {
            if ($tarea->estado_fk_tarea == \App\EstadosTareas::TAREA_CREADA) {
                $tarea->estado_fk_tarea = \App\EstadosTareas::TAREA_EN_DESARROLLO;
                $tarea->save();
            }

            $response = [
                'estado' => true,
                'mensaje' => 'El registro ha sido guardado'
            ];

        } else {
            $response = [
                'estado' => false,
                'mensaje' => 'Hubo un problema al guardar el registro. Intente nuevamente',
            ];

        }

        return response()->json($response);

    }


    public function cerrarTarea(Request $request)
    {
        $response = [];

        $id_tarea = $request->get('tarea');

        $tarea = $this->_Tareas->find($id_tarea);
        $tarea->estado_fk_tarea = \App\EstadosTareas::TAREA_CERRADA;
        $tarea->fecha_termino_tarea = date('Y-m-d');

        if ($tarea->save()) {
            $response = [
                'estado' => true,
                'mensaje' => 'La tarea ha sido cerrada',
                'redirect' => '/Tareas/misTareas'
            ];

            $tarea_trazabilidad = $this->_TareaTrazabilidad;
            $tarea_trazabilidad->fecha_trazabilidad = date('Y-m-d H:i:s');
            $tarea_trazabilidad->usuario_fk_trazabilidad = session()->get('id');
            $tarea_trazabilidad->descripcion_trazabilidad = 'Tarea CERRADA';
            $tarea_trazabilidad->tarea_fk_trazabilidad = $tarea->id_tarea;
            $tarea_trazabilidad->save();

            $insertEventoUsuario = [
                'usuario_fk_eu' => session()->get('id'),
                'fecha_eu' => date('Y-m-d H:i:s'),
                'detalle_eu' => 'Se cierra tarea : ' . $tarea->nombre_tarea,
            ];
            $this->_EventosUsuarios->insert($insertEventoUsuario);

            /** enviar correo a lider proyecto */
            $proyecto = $tarea->hito->proyecto;
            $lider = $proyecto->liderProyecto;
            Mail::to($lider->email_usuario, $lider->nombres_usuario. ' '.$lider->apellidos_usuario)
                ->send(new CerrarTarea($proyecto->nombre_proyecto, $tarea->nombre_tarea, \App\Helpers\Pangea\Fechas::formatearHtml($tarea->fecha_termino_tarea)));


        } else {
            $response = [
                'mensaje' => 'Hubo un problema al cerrar la Tarea. Intente nuevamente',
                'estado' => false,
            ];
        }

        return response()->json($response);

    }


    public function verTarea($id_tarea)
    {
        $tarea = $this->_Tareas->find($id_tarea);

        $tarea_trazabilidad = $this->_TareaTrazabilidad->where(['tarea_fk_trazabilidad' => $id_tarea])->get();

        $data = [
            'tarea' => $tarea,
            'listado' => $tarea_trazabilidad
        ];

        return view('tareas.ver-tarea', $data);
    }


    public function aprobarTarea(Request $request)
    {
        $response = array();

        $id_tarea = $request->get('tarea');
        $tarea = $this->_Tareas->find($id_tarea);
        $tarea->estado_fk_tarea = \App\EstadosTareas::TAREA_APROBADA;
        if ($tarea->save()) {

            $tarea_trazabilidad = $this->_TareaTrazabilidad;
            $tarea_trazabilidad->fecha_trazabilidad = date('Y-m-d H:i:s');
            $tarea_trazabilidad->usuario_fk_trazabilidad = session()->get('id');
            $tarea_trazabilidad->descripcion_trazabilidad = 'Tarea APROBADA';
            $tarea_trazabilidad->tarea_fk_trazabilidad = $id_tarea;
            $tarea_trazabilidad->save();

            $insertEventoUsuario = [
                'usuario_fk_eu' => session()->get('id'),
                'fecha_eu' => date('Y-m-d H:i:s'),
                'detalle_eu' => 'Se aprueba tarea : ' . $tarea->nombre_tarea,
            ];
            $this->_EventosUsuarios->insert($insertEventoUsuario);

            $response['estado'] = true;
            $response['mensaje'] = 'La tarea ha sido aprobada';
        } else {
            $response['estado'] =  false;
            $response['mensaje'] = 'Hubo un problema al aprobar la tarea. Intente nuevamente';
        }

        return response()->json($response);
    }

    public function rechazarTarea(Request $request)
    {
        $response = array();

        $id_tarea = $request->get('tarea');
        $comentario_rechazo = nl2br($request->get('comentario_rechazo'));

        $tarea = $this->_Tareas->find($id_tarea);
        $tarea->estado_fk_tarea = \App\EstadosTareas::TAREA_RECHAZADA;
        if ($tarea->save()) {

            $tarea_trazabilidad = $this->_TareaTrazabilidad;
            $tarea_trazabilidad->fecha_trazabilidad = date('Y-m-d H:i:s');
            $tarea_trazabilidad->usuario_fk_trazabilidad = session()->get('id');
            $tarea_trazabilidad->descripcion_trazabilidad = 'Tarea RECHAZADA : ' .$comentario_rechazo;
            $tarea_trazabilidad->tarea_fk_trazabilidad = $id_tarea;
            $tarea_trazabilidad->save();

            $insertEventoUsuario = [
                'usuario_fk_eu' => session()->get('id'),
                'fecha_eu' => date('Y-m-d H:i:s'),
                'detalle_eu' => 'Se rechaza tarea : ' . $tarea->nombre_tarea,
            ];
            $this->_EventosUsuarios->insert($insertEventoUsuario);

            /** enviar correo a responsable tarea*/
            $proyecto = $tarea->hito->proyecto;
            Mail::to($tarea->responsable->email_usuario, $tarea->responsable->nombres_usuario. ' '.$tarea->responsable->apellidos_usuario)
                ->send(new RechazarTarea($proyecto->nombre_proyecto, $tarea->nombre_tarea, $comentario_rechazo));

            $response['estado'] = true;
            $response['mensaje'] = 'La tarea ha sido rechazada';
        } else {
            $response['estado'] =  false;
            $response['mensaje'] = 'Hubo un problema al rechazar la tarea. Intente nuevamente';
        }

        return response()->json($response);
    }

    public function comentarioRechazoTarea($id_tarea)
    {
        $tarea = $this->_Tareas->find($id_tarea);

        $data = [
            'tarea' => $tarea
        ];

        return view('tareas.comentario-rechazo-tarea', $data);
    }

}
