<div class="row">
    <div class="col-xs-12">
        <form role="form" class="form-horizontal">
            <div class="box box-solid">
                <div class="box-body">

                    <input type="hidden" name="id" id="id" value="{{ $usuario->id_usuario }}" />
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-6 col-md-4">RUT (*)</label>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <input type="text" class="form-control" name="rut" id="rut" value="{{ $usuario->rut_usuario }}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-6 col-md-4">Nombres (*)</label>
                        <div class="col-xs-12 col-sm-6 col-md-8">
                            <input type="text" class="form-control" name="nombres" id="nombres" value="{{ $usuario->nombres_usuario }}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-6 col-md-4">Apellidos (*)</label>
                        <div class="col-xs-12 col-sm-6 col-md-8">
                            <input type="text" class="form-control" name="apellidos" id="apellidos" value="{{ $usuario->apellidos_usuario }}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-6 col-md-4">Email (*)</label>
                        <div class="col-xs-12 col-sm-6 col-md-8">
                            <input type="email" class="form-control" name="email" id="email" value="{{ $usuario->email_usuario }}" />
                        </div>
                    </div>
                        <div class="col-xs-12">
                            <div class="text-right">
                                <span class="help-block small">(*) datos obligatorios</span>
                            </div>
                        </div>


                </div>
                <div class="box-footer">
                    <div class="text-right">
                        <button type="button" class="btn btn-primary btn-flat" onclick="Usuario.actualizarMisDatos(this.form, this);">Guardar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

