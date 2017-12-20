<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{

    protected $table = 'usuarios';

    protected $primaryKey = 'id_usuario';

    public $timestamps = false;


    /**
     * Retorna listado de perfiles
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function perfiles(){
        return $this->belongsToMany('App\Perfiles', 'perfiles_usuarios', 'usuario_fk_pu', 'perfil_fk_pu');
    }


    public function getPerfilActivo($id_usuario){
        return \DB::table('perfiles_usuarios')->where(['activo_pu'=> 1,'usuario_fk_pu' => $id_usuario])->first();
    }

}
