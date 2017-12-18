<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <form role="form" class="form-horizontal">
                <input type="hidden" name="id_usuario" id="id_usuario" @if($usuario) value="{{ $usuario->id_usuario }}" @else value="0" @endif />
                <div class="box-body">
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-6 col-md-4">RUT</label>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <input type="text" class="form-control" name="rut" id="rut" @if($usuario) value="{{ $usuario->rut_usuario }}" @endif />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-6 col-md-4">Nombres</label>
                        <div class="col-xs-12 col-sm-6 col-md-8">
                            <input type="text" class="form-control" name="nombres" id="nombres" @if($usuario) value="{{ $usuario->nombres_usuario }}" @endif />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-6 col-md-4">Apellidos</label>
                        <div class="col-xs-12 col-sm-6 col-md-8">
                            <input type="text" class="form-control" name="apellidos" id="apellidos"  @if($usuario) value="{{ $usuario->apellidos_usuario }}" @endif />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-6 col-md-4">Email</label>
                        <div class="col-xs-12 col-sm-6 col-md-8">
                            <input type="email" class="form-control" name="email" id="email" @if($usuario) value="{{ $usuario->email_usuario }}" @endif />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-6 col-md-4 control-label">Perfiles</label>
                        <div class="col-xs-12 col-sm-6 col-md-8">
                            @foreach($perfiles as $perfil)
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="perfiles[]" class="perfiles" @if(in_array($perfil->id_perfil, $usuario->pu)) checked @endif  value="{{ $perfil->id_perfil }}" /> {{ $perfil->nombre_perfil }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="text-right">
                        <button type="button" class="btn btn-flat btn-primary" onclick="MantenedorUsuarios.guardarUsuario(this.form, this)">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>