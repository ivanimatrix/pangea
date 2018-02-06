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

    /**
     * Hitos de un proyecto
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hitosProyecto(){
        return $this->hasMany('App\HitosProyectos','proyecto_fk_hito', 'id_proyecto');
    }

    /**
     * Obtener estado de proyecto
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function estadoProyecto()
    {
        return $this->hasOne('App\EstadosProyectos', 'id_ep','estado_fk_proyecto');
    }

    /**
     * Obtener los roles del proyecto
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rolesProyecto()
    {
        return $this->hasMany('App\RolesProyectos', 'proyecto_fk_rp', 'id_proyecto');
    }

    public function usuariosProyecto()
    {
        return $this->hasMany('App\UsuariosProyectos', 'proyecto_fk_up', 'id_proyecto');
    }


    public function comentarios()
    {
        return $this->hasMany('App\ComentariosProyectos', 'proyecto_fk_comentarioproy','id_proyecto');
    }
}
