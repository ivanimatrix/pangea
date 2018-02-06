<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComentariosProyectos extends Model
{
    protected $table = 'comentarios_proyectos';

    protected $primaryKey = 'id_comentarioproy';

    public $timestamp = false;

    
    public function proyecto()
    {
        return $this->belongsTo('App\Proyectos', 'proyecto_fk_comentarioproy', 'id_proyecto');
    }


    public function usuario()
    {
        return $this->belongsTo('App\Usuarios', 'usuario_fk_comentarioproy', 'id_usuario');
    }

}
