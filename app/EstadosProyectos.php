<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadosProyectos extends Model
{

    const PROYECTO_CREADO = 1;
    const PROYECTO_FINALIZADO = 2;
    const PROYECTO_CERRADO = 3;
    const PROYECTO_PAUSADO = 4;
    const PROYECTO_EN_DESARROLLO = 5;

    protected $table = 'estados_proyectos';

    protected $primaryKey = 'id_ep';

    public $timestamps = false;





}
