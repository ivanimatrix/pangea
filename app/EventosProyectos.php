<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventosProyectos extends Model
{
    protected $table = 'eventos_proyectos';

    protected $primaryKey = 'id_evp';

    public $timestamps = false;


}
