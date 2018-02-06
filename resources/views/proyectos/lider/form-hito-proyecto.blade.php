<div class="row">
    <div class="col-xs-12">
        <form role="form">
            <input type="hidden" name="id_proyecto" id="id_proyecto" value="{{ $id_proyecto }}" />
            <input type="hidden" name="id_hito" id="id_hito"  @if(isset($hito)) value="{{ $hito->id_hito }}" @else value="0" @endif />
            <div class="box box-solid">
                <div class="box-body">
                    <div class="form-group">
                        <label>Nombre Hito (*)</label>
                        <input type="text" class="form-control" name="nombre_hito" id="nombre_hito" @if(isset($hito)) value="{{ $hito->nombre_hito }}" @endif />
                    </div>
                    <div class="form-group">
                        <label>Descripción</label>
                        <textarea class="form-control no-resize" name="descripcion_hito" id="descripcion_hito" rows="5">@if(isset($hito)){{ $hito->descripcion_hito }}@endif</textarea>
                    </div>
                </div>
                <div class="box-footer text-right">
                    <button type="button" class="btn btn-flat btn-success" onclick="HitosProyecto.guardarHito(this.form, this)">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>