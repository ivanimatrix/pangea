<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{


    public function dashboard()
    {
        return view('home.dashboard');
    }

    
    public function cargarPerfil()
    {
        $usuario = \App\Usuarios::find(session()->get('id'));

        return view('home.cargar-perfil', ['usuario' => $usuario]);
    }

}
