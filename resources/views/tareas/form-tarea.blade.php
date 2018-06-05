@extends('template')

@section('content')

    <section class="content-header">
        <h1>
            Desarrollo de Tarea
            <small>Tareas</small>
        </h1>
    </section>

    <section class="content">


        <div class="row">
            <div class="col-xs-12 col-md-5">
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="box-title">Ficha de la tarea</div>
                    </div>
                    <table class="table table-bordered table-striped">
                        <tbody>
                        <tr>
                            <td colspan="3">Nombre</td>
                        </tr>
                        <tr>
                            <td colspan="3">{{ $tarea->nombre_tarea }}</td>
                        </tr>
                        <tr>
                            <td>Fecha de Inicio</td>
                            <td>Días asignados</td>
                            <td>Prioridad</td>
                        </tr>
                        <tr>
                            <td>{{ \App\Helpers\Pangea\Fechas::formatearHtml($tarea->fecha_inicio_tarea) }}</td>
                            <td>{{ $tarea->dias_tarea }}</td>
                            <td>{{ $tarea->prioridad_tarea }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="box box-primary">
                    <form role="form" class="form-horizontal">
                        <input type="hidden" name="id_tarea_avance" name="id_tarea_avance" value="{{ $tarea->id_tarea }}" />
                        <div class="box-header with-border">
                            <div class="box-title">
                                Registrar avance
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-xs-12">Comentario de avance</label>
                                <div class="col-xs-12">
                                    <textarea class="form-control no-resize" rows="5" name="texto_avance" id="texto_avance" placeholder="Escriba aquí lo que corresponda a su avance"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-6 col-md-4 control-label">Horas dedicadas</label>
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <input type="text" class="form-control" name="horas_dedicadas" id="horas_dedicadas" />
                                </div>
                            </div>
                        </div>

                        <div class="box-footer">
                            <div class="text-right">
                                <button type="button" class="btn btn-flat btn-primary" onclick="window.location.href='{{ url('/Tareas/misTareas') }}'">Retornar a listado de tareas</button>
                                <button type="button" class="btn btn-flat btn-primary" onclick="Tareas.registrarAvance(this.form, this);">Registrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-xs-12 col-md-7">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div class="box-title">Trazabilidad</div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive" id="contenedor-trazabilidad-tarea"></div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection

@section('js')
    <script src="{{ url('public/js/plugins/dataTables.js') }}" type="text/javascript"></script>
    <script src="{{ url('public/js/modulos/tareas/Tareas.js?' . uniqid()) }}" type="text/javascript"></script>
    <script type="text/javascript">
        Tareas.trazabilidadTarea({{ $tarea->id_tarea }});
    </script>
@endsection