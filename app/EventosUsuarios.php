<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventosUsuarios extends Model
{
    protected $table = 'eventos_usuarios';

    protected $primaryKey = 'id_eu';

    public $timestamps = false;


    public function usuario()
    {
        $this->belongsTo('App\Usuarios', 'usuario_fk_eu', 'id_usuario');
    }

}
