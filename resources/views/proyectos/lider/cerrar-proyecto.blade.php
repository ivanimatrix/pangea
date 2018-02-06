<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <form role="form">
                <input type="hidden" name="id_proyecto_cierre" id="id_proyecto_cierre" value="{{ $id_proyecto }}" />
                <div class="box-body">
                    <div class="row">
                        <div class="form-group">
                            <label class="col-xs-12">Comentario de cierre</label>
                            <div class="col-xs-12">
                                <textarea class="form-control no-resize" rows="5" name="comentario_cierre_proyecto" id="comentario_cierre_proyecto"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer text-right">
                    <button type="button" class="btn btn-flat btn-primary" onclick="Proyectos.cerrarProyecto(this.form, this)">Cerrar Proyecto</button>
                </div>
            </form>
        </div>
    </div>
</div>