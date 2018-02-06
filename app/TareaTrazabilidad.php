<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TareaTrazabilidad extends Model
{
    protected $table = 'tarea_trazabilidad';

    protected $primaryKey = 'id_trazabilidad';

    public $timestamps = false;


    public function tarea()
    {
        return $this->belongsTo('App\Tareas', 'tarea_fk_trazabilidad', 'id_tarea');
    }


    public function usuario()
    {
        return $this->belongsTo('App\Usuarios', 'usuario_fk_trazabilidad', 'id_usuario');
    }

}
