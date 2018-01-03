<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfiles extends Model
{

    const ADMINISTRADOR_GENERAL = 1;
    const ADMINISTADOR_PROYECTOS = 2;
    const LIDER = 3;
    const COLABORADOR = 4;


    protected $table = 'perfiles';

    protected $primaryKey = 'id_perfil';

    public $timestamps = false;

    /**
     * Retorna listado de usuarios
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function usuarios(){
        return $this->belongsToMany('App\Usuarios','perfiles_usuarios','perfil_fk_pu', 'usuario_fk_pu');
    }


}
