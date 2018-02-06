<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ComentariosProyectos;
use App\Proyectos;

class ComentariosProyectoController extends Controller
{

    /**
     * Modelo ComentariosProyectos
     *
     * @var \App\ComentariosProyectos;
     */
    protected $_ComentariosProyectos;

    /**
     * Modelo Proyectos
     *
     * @var \App\Proyectos
     */
    protected $_Proyectos;

    public function __construct()
    {
        $this->_ComentariosProyectos = new ComentariosProyectos();
        $this->_Proyectos = new Proyectos();
    }
    
    public function listado($id_proyecto)
    {
        $proyecto = $this->_Proyectos->find($id_proyecto);

        $data = [
            'comentarios' => $proyecto->comentarios
        ];

        return view('proyectos.lider.listado-comentarios-proyecto', $data);
    }


    public function registrarComentario(Request $request)
    {
        $response = [
            'estado' => false,
            'mensaje' => 'Su comentario no ha podido ser registrado. Intente nuevamente'
        ];

        $id_proyecto = $request->get('proyecto');
        $texto = $request->get('texto');

        $insertComentario = [
            'proyecto_fk_comentarioproy' => $id_proyecto,
            'fecha_comentarioproy' => date('Y-m-d H:i:s'),
            'usuario_fk_comentarioproy' => session()->get('id'),
            'texto_comentarioproy' => $texto
        ];

        if ($this->_ComentariosProyectos->insert($insertComentario)) {
            $response['estado'] = true;
        }

        return response()->json($response);
    }

}
