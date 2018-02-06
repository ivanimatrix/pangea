<div class="row">
    <div class="col-xs-12">
        <form role="form">
            <div class="box box-primary">
                <input type="hidden" name="id_hito_tarea" id="id_hito_tarea" value="{{ $tarea->hito->id_hito }}" />
                <input type="hidden" name="id_tarea_rechazo" id="id_tarea_rechazo" value="{{ $tarea->id_tarea }}" />
                <div class="box-body">
                    <div class="row">
                        <div class="form-group">
                            <label class="col-xs-12">Ingrese su comentario</label>
                            <div class="col-xs-12">
                                <textarea class="form-control no-resize" rows="5" name="comentario_rechazo_tarea" id="comentario_rechazo_tarea" ></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer text-right">
                    <button type="button" class="btn btn-flat btn-success" onclick="Tareas.rechazarTarea(this.form, this);">Registrar Rechazo</button>
                </div>
            </div>
        </form>
    </div>
</div>