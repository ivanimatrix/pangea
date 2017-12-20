<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TiposEventosProyectos extends Model
{

    protected $table = 'tipos_eventos_proyectos';

    protected $primaryKey = 'id_tep';

    public $timestamps = false;
}
