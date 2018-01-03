<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HitosProyectos extends Model
{
    protected $table = 'hitos_proyectos';

    protected $primaryKey = 'id_hito';

    protected $fillable = ['nombre_hito'];

    public $timestamps = false;


    public function proyecto()
    {
        return $this->belongsTo('App\Proyectos', 'proyecto_fk_hito', 'id_proyecto');
    }


}
