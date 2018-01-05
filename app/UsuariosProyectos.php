<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuariosProyectos extends Model
{
    protected $table = 'usuarios_proyectos';

    public $timestamps = false;

    public function roles(){
        return $this->belongsToMany('App\RolesProyectos', 'usuarios_roles', 'usuario_fk_ur', 'rol_fk_ur');
    }

    public function usuario()
    {
        return $this->belongsTo('App\Usuarios', 'usuario_fk_up', 'id_usuario');
    }
}
