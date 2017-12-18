<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfiles extends Model
{
    
    public const ADMINISTRADOR_GENERAL = 1;
    public const ADMINISTADOR_PROYECTOS = 2;
    public const LIDER = 3;
    public const COLABORADOR = 4;


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
