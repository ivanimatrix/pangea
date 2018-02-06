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

    public function tareas()
    {
        //return \DB::table('tareas')->where(['tipo_padre_fk_tarea' => 2, 'padre_fk_tarea' => $id_hito])->get();
        return $this->hasMany('App\Tareas', 'padre_fk_tarea', 'id_hito');
    }


}
