<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfiles extends Model
{
    
    public const ADMINISTRADOR_GENERAL = 1;
    public const ADMINISTADOR_PROYECTOS = 2;
    public const LIDER = 3;
    public const COLABORADOR = 4;

}
