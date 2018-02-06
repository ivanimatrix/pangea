@extends('template')

@section('content')

<section class="content-header">
    <h1>
        Desarrollo de Tarea
        <small>Tareas</small>
    </h1>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            <div class="box-title">Ficha de la tarea</div>
        </div>
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <td colspan="3">Nombre</td>
                    <td colspan="3">{{ $tarea->nombre_tarea }}</td>
                </tr>
                <tr>
                    <td>Fecha de Inicio</td>
                    <td>{{ \App\Helpers\Pangea\Fechas::formatearHtml($tarea->fecha_inicio_tarea) }}</td>
                    <td>Días asignados</td>
                    <td>{{ $tarea->dias_tarea }}</td>
                    <td>Prioridad</td>
                    <td>{{ $tarea->prioridad_tarea }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-title">Trazabilidad</div>
                </div>
                <div class="box-body">
                    <div class="table-responsive small" id="contenedor-trazabilidad-tarea"></div>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-md-6">
            <div class="box box-primary">
                <form role="form">
                    <input type="hidden" name="id_tarea_avance" name="id_tarea_avance" value="{{ $tarea->id_tarea }}" />
                    <div class="box-header with-border">
                        <div class="box-title">
                            Registrar avance
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                                <textarea class="form-control no-resize" rows="10" name="texto_avance" id="texto_avance" placeholder="Escriba aquí lo que corresponda a su avance"></textarea>
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