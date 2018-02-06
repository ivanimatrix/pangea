<div class="row">
    <div class="col-xs-12">
        <div class="box box-solid">
            <form role="form" id="form-tarea-proyecto">
                <input type="hidden" name="id_tarea" value="{{ $id_tarea }}" />
                <input type="hidden" name="tipo_padre" value="{{ $tipo_padre }}" />
                <input type="hidden" name="id_padre" value="{{ $id_padre }}" />
                <input type="hidden" name="proyecto_tarea" value="{{ $proyecto->id_proyecto }}" />
                <div class="box-body">
                    <div class="form-group">
                        <label>Nombre Tarea (*)</label>
                        <input type="text" name="nombre_tarea" id="nombre_tarea" class="form-control" @if(isset($tarea)) value="{{ $tarea->nombre_tarea }}" @endif />
                    </div>
                    <div class="form-group">
                        <label>Responsable (*)</label>
                        <select class="form-control" name="responsable_tarea" id="responsable_tarea">
                            <option value="">Seleccione</option>
                            <option value="{{ $proyecto->liderProyecto->id_usuario }}" @if(isset($tarea) and $tarea->responsable_fk_tarea == $proyecto->liderProyecto->id_usuario) selected @endif>{{ $proyecto->liderProyecto->nombres_usuario .' '.$proyecto->liderProyecto->apellidos_usuario }}</option>
                            @if (count($proyecto->usuariosProyecto) > 0)
                                @foreach ($proyecto->usuariosProyecto as $usuarioProy)
                                    <option value="{{ $usuarioProy->usuario_fk_up }}" @if(isset($tarea) and $tarea->responsable_fk_tarea == $usuarioProy->usuario_fk_up) selected @endif  >{{ $usuarioProy->usuario->nombres_usuario }} {{ $usuarioProy->usuario->apellidos_usuario }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <label>Fecha Inicio (*)</label>
                                <input type="text" class="form-control datepicker" id="fecha_inicio_tarea" name="fecha_inicio_tarea" readonly  @if(isset($tarea)) value="{{ \App\Helpers\Pangea\Fechas::formatearHtml($tarea->fecha_inicio_tarea) }}" @endif />
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <label>Dias (*)</label>
                                <input type="number" class="form-control" name="dias_tarea" id="dias_tarea" @if(isset($tarea)) value="{{ $tarea->dias_tarea }}" @endif />
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <label>Prioridad (*)</label>
                                <select class="form-control" name="prioridad_tarea" id="prioridad_tarea">
                                    <option value="1" @if(isset($tarea) and $tarea->prioridad_tarea == 1) selected @endif >1</option>
                                    <option value="2" @if(isset($tarea) and $tarea->prioridad_tarea == 2) selected @endif >2</option>
                                    <option value="3" @if(isset($tarea) and $tarea->prioridad_tarea == 3) selected @endif >3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Descripción</label>
                        <textarea class="form-control no-resize" name="descripcion_tarea" id="descripcion_tarea" rows="5" >@if(isset($tarea)){{$tarea->descripcion_tarea}}@endif</textarea>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="text-right">
                        <button type="button" class="btn btn-flat btn-primary" onclick="TareasProyecto.guardarTarea(this.form, this);">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    Calendario.init();
</script>