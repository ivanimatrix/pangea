<div class="row">
    <div class="col-xs-12">
        <div class="box box-solid">
            <form role="form" class="form-horizontal">
                <div class="box-body">

                    <div class="form-group">
                        <label class="control-label col-xs-12 col-md-4 col-sm-6">Nueva contraseña</label>
                        <div class="col-xs-12 col-sm-6 col-md-8">
                            <input type="password" id="nueva_pass" class="form-control" name="nueva_pass">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-md-4 col-sm-6">Repetir contraseña</label>
                        <div class="col-xs-12 col-sm-6 col-md-8">
                            <input type="password" id="repetir_pass" class="form-control" name="repetir_pass">
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="text-right">
                        <button type="button" class="btn btn-flat btn-primary" onclick="Usuario.actualizarPassword(this.form, this)">Actualizar contraseña</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>