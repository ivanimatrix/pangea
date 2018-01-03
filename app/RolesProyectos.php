<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolesProyectos extends Model
{
    protected $table = 'roles_proyectos';

    protected $primaryKey = 'id_rp';

    public $timestamps = false;

    /**
     * Obtener proyecto del rol
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function proyecto()
    {
        return $this->belongsTo('App\Proyectos', 'proyecto_fk_rp', 'id_proyecto');
    }
}
