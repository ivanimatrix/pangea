<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tareas extends Model
{
    protected $table = 'tareas';

    protected $primaryKey = 'id_tarea';

    public $timestamps = false;

}
