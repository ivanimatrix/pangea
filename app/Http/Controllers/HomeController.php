<?php

namespace App\Http\Controllers;

use App\EventosUsuarios;
use App\Proyectos;
use App\Usuarios;
use App\Tareas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\EstadosProyectos;
use App\EstadosTareas;
use Psy\Util\Json;

class HomeController extends Controller
{

    /** @var Usuarios */
    protected $_Usuarios;

    /** @var Proyectos */
    protected $_Proyectos;

    /** @var EventosUsuarios */
    protected $_EventosUsuarios;

    /**
     * Modelo \App\Tareas
     *
     * @var \App\Tareas
     */
    protected $_Tareas;

    public function __construct()
    {
        $this->_Usuarios = new Usuarios();
        $this->_Proyectos = new Proyectos();
        $this->_EventosUsuarios = new EventosUsuarios();
        $this->_Tareas = new Tareas();
    }

    public function dashboard()
    {
        $total_usuarios = $this->_Usuarios->count();
        $total_proyectos = $this->_Proyectos->count();
        $total_eventos = 0;
        $usuario = $this->_Usuarios->find(session()->get('id'));
        $eventos_usuarios = $usuario->eventos()->orderBy('fecha_eu','desc')->limit(10)->get();
        if($eventos_usuarios){
            $total_eventos = count($eventos_usuarios);
        }

        /** estados proyectos */
        $grafico_proyectos = [
            "CREADOS" => $this->_Proyectos->where('estado_fk_proyecto', \App\EstadosProyectos::PROYECTO_CREADO)->count(),
            "EN DESARROLLO" => $this->_Proyectos->where('estado_fk_proyecto', \App\EstadosProyectos::PROYECTO_EN_DESARROLLO)->count(),
            "CERRADOS" => $this->_Proyectos->where('estado_fk_proyecto', \App\EstadosProyectos::PROYECTO_CERRADO)->count(),
            "FINALIZADOS" => $this->_Proyectos->where('estado_fk_proyecto', \App\EstadosProyectos::PROYECTO_FINALIZADO)->count(),
            "PAUSADOS" => $this->_Proyectos->where('estado_fk_proyecto', \App\EstadosProyectos::PROYECTO_PAUSADO)->count(),
        ];

        $data = [
            'total_usuarios' => $total_usuarios,
            'total_proyectos' => $total_proyectos,
            'total_eventos' => $total_eventos,
            'eventos_usuarios' => $eventos_usuarios,
            'grafico_proyectos' => $grafico_proyectos
        ];

        $data['titulo_grafico'] = 'Proyectos';

        if (session()->get('perfil') == \App\Perfiles::LIDER) {
            /** estados proyectos */
            $grafico_proyectos = [
                "CREADOS" => $this->_Proyectos->where(['estado_fk_proyecto' => \App\EstadosProyectos::PROYECTO_CREADO, 'responsable_fk_proyecto' => session()->get('id') ])->count(),
                "EN DESARROLLO" => $this->_Proyectos->where(['estado_fk_proyecto' => \App\EstadosProyectos::PROYECTO_EN_DESARROLLO, 'responsable_fk_proyecto' => session()->get('id')])->count(),
                "CERRADOS" => $this->_Proyectos->where(['estado_fk_proyecto' => \App\EstadosProyectos::PROYECTO_CERRADO, 'responsable_fk_proyecto' => session()->get('id')])->count(),
                "FINALIZADOS" => $this->_Proyectos->where(['estado_fk_proyecto' => \App\EstadosProyectos::PROYECTO_FINALIZADO, 'responsable_fk_proyecto' => session()->get('id')])->count(),
                "PAUSADOS" => $this->_Proyectos->where(['estado_fk_proyecto' => \App\EstadosProyectos::PROYECTO_PAUSADO, 'responsable_fk_proyecto' => session()->get('id')])->count(),
            ];

            $total_proyectos_lider = $this->_Proyectos->where('responsable_fk_proyecto', session()->get('id'))->count();
            $data['total_proyectos_lider'] = $total_proyectos_lider;
            $data['grafico_proyectos'] = $grafico_proyectos;
            $data['titulo_grafico'] = 'Proyectos';
        }

        if (session()->get('perfil') == \App\Perfiles::COLABORADOR) {
            /** estados proyectos */
            $grafico_proyectos = [
                "CREADA" => $this->_Tareas->where(['estado_fk_tarea' => EstadosTareas::TAREA_CREADA , 'responsable_fk_tarea' => session()->get('id')])->count(),
                "EN DESARROLLO" => $this->_Tareas->where(['estado_fk_tarea' => EstadosTareas::TAREA_EN_DESARROLLO, 'responsable_fk_tarea' => session()->get('id')])->count(),
                "CERRADA" => $this->_Tareas->where(['estado_fk_tarea' => EstadosTareas::TAREA_CERRADA, 'responsable_fk_tarea' => session()->get('id')])->count(),
                "APROBADA" => $this->_Tareas->where(['estado_fk_tarea' => EstadosTareas::TAREA_APROBADA, 'responsable_fk_tarea' => session()->get('id')])->count(),
                "RECHAZADA" => $this->_Tareas->where(['estado_fk_tarea' => EstadosTareas::TAREA_RECHAZADA, 'responsable_fk_tarea' => session()->get('id')])->count(),
            ];

            $total_tareas_asignadas = $this->_Tareas->where('responsable_fk_tarea', session()->get('id'))->count();
            $data['total_tareas_asignadas'] = $total_tareas_asignadas;
            $data['grafico_proyectos'] = $grafico_proyectos;
            $data['titulo_grafico'] = 'Tareas';
        }
        
        return view('home.dashboard', $data);
    }

    
    public function cargarPerfil()
    {
        $usuario = \App\Usuarios::find(session()->get('id'));

        return view('home.cargar-perfil', ['usuario' => $usuario]);
    }

}
