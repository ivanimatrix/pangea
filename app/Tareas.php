<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tareas extends Model
{
    protected $table = 'tareas';

    protected $primaryKey = 'id_tarea';

    public $timestamps = false;


    public function responsable()
    {
        return $this->hasOne('App\Usuarios', 'id_usuario', 'responsable_fk_tarea');
    }

    public function estado()
    {
        return $this->belongsTo('App\EstadosTareas', 'estado_fk_tarea', 'id_et');
    }

    public function hito()
    {
        return $this->belongsTo('App\HitosProyectos', 'padre_fk_tarea', 'id_hito');
    }

    public function trazabilidad()
    {
        return $this->hasMany('App\TareaTrazabilidad', 'tarea_fk_trazabilidad', 'id_tarea');
    }

}
