<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <form role="form">
                <input type="hidden" name="proyecto" id="proyecto" value="{{ $id_proyecto }}" />
                <div class="box-body">
                    <div class="form-group">
                        <label>Integrante (*)</label>
                        <select class="form-control" name="id_usuario" id="id_usuario">
                            <option value="">Seleccione...</option>
                            @if ($usuarios)
                                @foreach ($usuarios as $usuario)
                                    <option value="{{ $usuario->id_usuario }}">{{ $usuario->nombres_usuario }} {{ $usuario->apellidos_usuario }}</option>
                                @endforeach
                            @endif

                        </select>
                    </div>
                    <div class="form-group">
                        <label>Roles (*)</label>
                        <div class="col-xs-12">
                        @if ($roles)
                            @foreach ($roles as $rol)
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="roles_usuario[]" class="roles_usuario" value="{{ $rol->id_rp }}" /> {{ $rol->nombre_rp }}
                                    </label>
                                </div>
                            @endforeach
                        @endif
                        </div>
                    </div>

                    <div class="text-right">
                        <button type="button" class="btn btn-primary btn-flat" onclick="UsuariosProyecto.guardarUsuarioProyecto(this.form, this)">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>