<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <form role="form" id="form-editar-avatar">
                <div class="box-body">
                    <div class="form-group">
                        <label>Seleccione su imagen</label>
                        <input type="file" class="form-control" name="avatar" id="avatar"/>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="text-right">
                        <button type="button" class="btn btn-primary btn-flat" onclick="Usuario.cambiarAvatar(this.form, this);">Cambiar Avatar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
