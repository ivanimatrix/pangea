<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuariosProyectos extends Model
{
    protected $table = 'usuarios_proyectos';

    protected $primaryKey = 'id_up';

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('App\RolesProyectos', 'usuarios_roles', 'integrante_fk_ur', 'rol_fk_ur');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function usuario()
    {
        return $this->hasOne('App\Usuarios','id_usuario', 'usuario_fk_up');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function proyecto()
    {
        return $this->hasOne('App\Proyectos','proyecto_fk_up','id_proyecto');
    }
}
