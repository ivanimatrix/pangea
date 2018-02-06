<?php

namespace App\Http\Controllers;

use App\Helpers\Pangea\Fechas;
use App\Mail\AsignacionProyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\EventosUsuarios;
use PDF;

class ProyectosController extends Controller
{

    /** @var \App\Proyectos */
    protected $_Proyectos;

    /** @var \App\Usuarios */
    protected $_Usuarios;

    /** @var \App\Perfiles */
    protected $_Perfiles;

    /** @var \App\EstadosProyectos */
    protected $_EstadosProyectos;

    /**
     * Modelo EventosUsuarios
     *
     * @var \App\EventosUsuarios
     */
    protected $_EventosUsuarios;


    public function __construct()
    {
        $this->_Proyectos = new \App\Proyectos();
        $this->_EstadosProyectos = new \App\EstadosProyectos();
        $this->_EventosUsuarios = new EventosUsuarios();
    }


    public function index()
    {

        return view('proyectos.index-proyectos');
    }

    public function formProyecto($id = null)
    {
        $data = [];

        $this->_Perfiles = new \App\Perfiles();

        $data['usuarios'] = $this->_Perfiles->find(\App\Perfiles::LIDER)->usuarios()->get();

        if(is_null($id)){
            $this->_Proyectos = new \App\Proyectos();
            $data['proyecto'] = $this->_Proyectos->find($id);
        }else{
            $data['proyecto'] = $this->_Proyectos->find($id);
        }

        return view('proyectos.form-proyecto', $data);
    }


    public function guardarProyecto(Request $request)
    {
        $response = [
            'estado' => false,
            'mensaje' => 'Hubo un problema al guardar los datos. Intente nuevamente'
        ];

        $guardar = false;
        $enviar_mail = false;
        $edicion = false;
        if($request->get('proyecto_id') > 0){
            $edicion = true;
            $proyecto = $this->_Proyectos->find($request->get('proyecto_id'));
            if($proyecto->responsable_fk_proyecto != $request->get('responsable_proyecto')){
                $enviar_mail = true;
            }
        }else{
            $proyecto = $this->_Proyectos;
            $proyecto->estado_fk_proyecto = \App\EstadosProyectos::PROYECTO_CREADO;
            $proyecto->fecha_creacion_proyecto = date('Y-m-d H:i:s');
            $enviar_mail = true;
        }
        $proyecto->hitos_proyecto = $request->get('tiene_hitos_proyecto') ? $request->get('tiene_hitos_proyecto') : 0;
        $proyecto->nombre_proyecto = $request->get('nombre_proyecto');
        $proyecto->fecha_inicio_proyecto = Fechas::formatearBaseDatos($request->get('fecha_proyecto'));
        $proyecto->responsable_fk_proyecto = $request->get('responsable_proyecto');
        $proyecto->descripcion_proyecto = $request->get('descripcion_proyecto');

        if($proyecto->save()){
            if($enviar_mail){
                $this->_Usuarios = new \App\Usuarios();
                $usuario = $this->_Usuarios->find($request->get('responsable_proyecto'));
                /* enviar correo con nueva password */
                Mail::to($usuario->email_usuario, $usuario->nombres_usuario)
                    ->send(new AsignacionProyecto($usuario->nombres_usuario. ' ' .$usuario->apellidos_usuario, $request->get('nombre_proyecto')));
            }

            if ($edicion) {
                $insertEventoUsuario = [
                    'usuario_fk_eu' => session()->get('id'),
                    'fecha_eu' => date('Y-m-d H:i:s'),
                    'detalle_eu' => 'Se realiza una edición a proyecto: ' . $proyecto->nombre_proyecto,
                ];
            } else {
                $insertEventoUsuario = [
                    'usuario_fk_eu' => session()->get('id'),
                    'fecha_eu' => date('Y-m-d H:i:s'),
                    'detalle_eu' => 'Se crea nuevo proyecto: ' . $proyecto->nombre_proyecto,
                ];
            }
            
            $this->_EventosUsuarios->insert($insertEventoUsuario);

            /*if($request->get('tiene_hitos_proyecto')){
                $hitos = $request->get('listado_hitos');
                foreach ($hitos as $hito){
                    $insert_hito = $proyecto->hitosProyecto()->create(
                        ['nombre_hito' => $hito]
                    );
                }
            }*/
            $response['estado'] = true;
            $response['mensaje'] = 'Proyecto guardado correctamente';
        }


        return response()->json($response);
    }


    public function listadoProyectos()
    {
        $proyectos = $this->_Proyectos->all();

        return view('proyectos.grilla-proyectos', ['proyectos' => $proyectos]);
    }


    public function detalleProyecto($id)
    {
        $proyecto = $this->_Proyectos->find($id);

        return view(
            'proyectos.detalle-proyecto', ['proyecto' => $proyecto]);
    }


    public function reportePdf($id)
    {

        $proyecto = $this->_Proyectos->find($id);
        $data = [
            'proyecto' => $proyecto
        ];
        $pdf = PDF::loadView('proyectos.pdf.reporte-proyecto', $data);
        return $pdf->stream('Reporte_Proyecto.pdf');
    }


    public function finalizarProyecto(Request $request)
    {
        $id_proyecto = $request->get('proyecto');

        $proyecto = $this->_Proyectos->find($id_proyecto);
        $proyecto->estado_fk_proyecto = \App\EstadosProyectos::PROYECTO_FINALIZADO;
        if ($proyecto->save()) {
            $response['estado'] = true;
            $response['mensaje'] = 'El proyecto ha sido finalizado';

            $insertEventoUsuario = [
                'usuario_fk_eu' => session()->get('id'),
                'fecha_eu' => date('Y-m-d H:i:s'),
                'detalle_eu' => 'Se finaliza proyecto: ' . $proyecto->nombre_proyecto,
            ];

            $this->_EventosUsuarios->insert($insertEventoUsuario);
        } else {
            $response['estado'] = false;
            $response['mensaje'] = 'Hubo un problema al finalizar el proyecto. Intente nuevamente';
        }

        return response()->json($response);
    }

}
