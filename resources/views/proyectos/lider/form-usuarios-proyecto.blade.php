<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <form role="form">
                <input type="hidden" name="proyecto" id="proyecto" value="{{ $id_proyecto }}" />
                <input type="hidden" name="id_usuario" id="id_usuario" @if (isset($edicion)) value="{{ $usuarios->usuario_fk_up }}" @else value="0" @endif />
                
                <div class="box-body">
                    <div class="form-group">
                        @if (isset($edicion))
                            <div class="well well-sm">Integrada al Proyecto el <strong>{{ \App\Helpers\Pangea\Fechas::formatearHtml($usuarios->fecha_registro_up) }}</strong></div>
                        @else
                            <label>Integrante (*)</label>
                            <select class="form-control" name="integrante" id="integrante">
                                <option value="">Seleccione...</option>
                                @if ($usuarios)
                                    @foreach ($usuarios as $usuario)
                                        <option value="{{ $usuario->id_usuario }}">{{ $usuario->nombres_usuario }} {{ $usuario->apellidos_usuario }}</option>
                                    @endforeach
                                @endif

                            </select>
                        @endif

                    </div>
                    <div class="form-group">
                        <label>Roles (*)</label>
                        <div class="col-xs-12">
                            @if (count($roles) > 0)
                                @foreach ($roles as $rol)
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="roles_usuario[]" class="roles_usuario" value="{{ $rol->id_rp }}" @if(isset($roles_usuario) and  in_array($rol->id_rp, $roles_usuario)) checked @endif  /> {{ $rol->nombre_rp }}
                                        </label>
                                    </div>
                                @endforeach
                            @else
                            <div class="row">
                                <div class="callout callout-warning">
                                    <strong>No se han ingresado roles al proyecto</strong>
                                </div>
                            </div>
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