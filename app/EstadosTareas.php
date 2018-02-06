<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadosTareas extends Model
{
    const TAREA_CREADA = 1;
    const TAREA_EN_DESARROLLO = 2;
    const TAREA_CERRADA = 3;
    const TAREA_APROBADA = 4;
    const TAREA_RECHAZADA = 5;

    protected $table = 'estados_tareas';

    protected $primaryKey = 'id_et';

    public $timestamps = false;


    public function tareas()
    {
        return $this->hasMany('App\Tareas', 'estado_fk_tarea', 'id_et');
    }
}
