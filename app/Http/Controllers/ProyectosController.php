<?php

namespace App\Http\Controllers;

use App\Helpers\Pangea\Fechas;
use App\Mail\AsignacionProyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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


    public function __construct()
    {
        $this->_Proyectos = new \App\Proyectos();
        $this->_EstadosProyectos = new \App\EstadosProyectos();
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
        if($request->get('proyecto_id') > 0){
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

        if($proyecto->save()){
            if($enviar_mail){
                $this->_Usuarios = new \App\Usuarios();
                $usuario = $this->_Usuarios->find($request->get('responsable_proyecto'));
                /* enviar correo con nueva password */
                Mail::to($usuario->email_usuario, $usuario->nombres_usuario)
                    ->send(new AsignacionProyecto($usuario->nombres_usuario. ' ' .$usuario->apellidos_usuario, $request->get('nombre_proyecto')));
            }


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

}
