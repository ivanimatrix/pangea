<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyectos extends Model
{

    protected $table = 'proyectos';

    protected $primaryKey = 'id_proyecto';

    public $timestamps = false;

    /**
     * Obtener lider de proyecto
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function liderProyecto()
    {
        return $this->hasOne('App\Usuarios', 'id_usuario','responsable_fk_proyecto');
    }

    /**
     * Obtener el historial de eventos de un proyecto
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function eventosProyecto()
    {
        return $this->hasMany('App\EventosProyectos', 'proyecto_fk_evp', 'id_proyecto');
    }

}
