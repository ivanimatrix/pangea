<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <form role="form">
                <input type="hidden" value="{{ $id_proyecto }}" id="id_proyecto" name="id_proyecto" />
                <input type="hidden" value="{{ $id_rol }}" name="id_rol" id="id_rol" />
                <div class="box-body">
                    <div class="form-group">
                        <label>Nombre Rol (*)</label>
                        <input type="text" class="form-control" name="nombre_rol" id="nombre_rol"  @if($rol) value="{{ $rol->nombre_rp }}" @endif />
                    </div>
                    <div class="form-group">
                        <label>Descripción</label>
                        <textarea class="form-control no-resize" name="descripcion_rol" id="descripcion_rol" rows="5">@if ($rol){{ $rol->descripcion_rp }}@endif</textarea>
                    </div>
                    <div class="form-group">
                        <div class="text-right">
                            <button type="button" class="btn btn-flat btn-primary" onclick="Proyectos.guardarRolProyecto(this.form, this);">Guardar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>