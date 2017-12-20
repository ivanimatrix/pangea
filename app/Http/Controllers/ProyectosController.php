<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProyectosController extends Controller
{

    public function formProyecto($id = null)
    {
        return view('proyectos.form-proyecto');
    }

}
