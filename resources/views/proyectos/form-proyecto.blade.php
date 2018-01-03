@extends('template')

@section('content')

    <section class="content-header">
        <h1>
            Datos Proyecto
            <small>Proyectos</small>
        </h1>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="box-title">
                    Formulario de Proyecto
                </div>
                <form class="form-horizontal" role="form">
                    <input type="hidden" name="proyecto_id" id="proyecto_id" value="@if($proyecto){{ $proyecto->id_proyecto }}@else{{ '0' }}@endif" />
                    <div class="box-body">
                        <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-6 col-md-4">Nombre del Proyecto</label>
                            <div class="col-xs-12 col-sm-6 col-md-8">
                                <input type="text" name="nombre_proyecto" id="nombre_proyecto" class="form-control" value="@if($proyecto){{ $proyecto->nombre_proyecto }}@endif" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-6 col-md-4">Fecha de Inicio</label>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="input-group">
                                    <input type="text" name="fecha_proyecto" id="fecha_proyecto" class="form-control datepicker" data-start-date="{{ date('d/m/Y') }}" readonly value="@if($proyecto){{ Fechas::formatearHtml($proyecto->fecha_inicio_proyecto)}}@endif" />
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-6 col-md-4">Responsable</label>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <select class="form-control" name="responsable_proyecto" id="responsable_proyecto">
                                    <option value="">Seleccione responsable...</option>
                                    @if($usuarios)
                                        @foreach($usuarios as $usuario)
                                            <option value="{{ $usuario->id_usuario }}" @if($proyecto and $usuario->id_usuario == $proyecto->responsable_fk_proyecto) selected @endif  >{{ $usuario->nombres_usuario }} {{ $usuario->apellidos_usuario }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        {{--<div class="form-group">
                            <label class="control-label col-xs-12 col-sm-6 col-md-4">Proyecto con Hitos</label>
                            <div class="col-xs-12 col-md-8 col-sm-6">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="1" name="tiene_hitos_proyecto" id="tiene_hitos_proyecto" onclick="Proyectos.activarContenedorHitos(this);"  @if($proyecto->hitos_proyecto) checked @endif /> Si
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12" id="contenedor-hitos-proyecto" @if(!$proyecto->hitos_proyecto)  style="display:none" @endif >
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <span class="help-block">Ingrese el nombre del hito y presione el botón "Agregar Hito al listado" para ir registrándolo</span>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="tmp_nombre_hito" id="tmp_nombre_hito" placeholder="Escriba nombre del hito"/>
                                                    <div class="input-group-btn">
                                                        <button type="button" class="btn btn-success btn-flat" onclick="Proyectos.agregaHitoListado('tmp_nombre_hito');">Agregar Hito al listado</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <label class="col-xs-12 top-spaced">Listado de Hitos</label>
                                            <div class="col-xs-12">
                                                <div class="col-xs-12" id="contenedor-listado-hitos-proyecto">
                                                    @if ($proyecto->hitos_proyecto)
                                                        @php ($i = 1)

                                                        @foreach ($proyecto->hitosProyecto as $hito)
                                                            <div class="row item_hito" id="item_hito_{{ $i }}">
                                                                <button type="button" class="btn btn-sm btn-flat btn-danger" onclick="Proyectos.sacarHitoListado({{ $i  }});"><i class="fa fa-trash-o"></i></button>
                                                                <input type="hidden" name="listado_nombres_hitos[]" id="hito_nombre_{{ $i }}" value="{{ $hito->nombre_hito }}" />
                                                                <input type="hidden" name="listado_hitos[]" id="hito_{{ $i }}" value="{{ $hito->id_hito }}" /> {{ $hito->nombre_hito }}
                                                            </div>
                                                            @php($i++)
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>--}}
                    </div>
                    <div class="box-footer">
                        <div class="text-right">
                            <button type="button" class="btn btn-flat btn-primary" onclick="Proyectos.guardarProyecto(this.form, this);">Guardar Proyecto</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection


@section('js')
    <script src="{{ asset('public/js/plugins/calendario.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/js/modulos/proyectos/Proyectos.js') }}" type="text/javascript"></script>
@endsection