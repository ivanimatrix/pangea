<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="box-title">Información</div>
            </div>
            <div class="box-body small">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <td colspan="6"><strong>Nombre</strong></td>
                    </tr>
                    <tr>
                        <td colspan="6">{{ $tarea->nombre_tarea }}</td>
                    </tr>
                    <tr>
                        <td><strong>Fecha Inicio</strong></td>
                        <td>{{ \App\Helpers\Pangea\Fechas::formatearHtml($tarea->fecha_inicio_tarea) }}</td>
                        <td><strong>Días</strong></td>
                        <td>{{ $tarea->dias_tarea }}</td>
                        <td><strong>Fecha Término</strong></td>
                        <td>{{ \App\Helpers\Pangea\Fechas::formatearHtml($tarea->fecha_termino_tarea) }}</td>
                    </tr>
                    <tr>
                        <td><strong>Responsable</strong></td>
                        <td colspan="5">{{ $tarea->responsable->nombres_usuario . ' ' . $tarea->responsable->apellidos_usuario }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="box-header with-border ">
                <div class="box-title">Trazabilidad</div>
            </div>
            <div class="box-body small">
                <table class="table table-bordered table-condensed table-striped">
                    <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Descripción</th>
                        <th>Usuario</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($listado))
                        @foreach ($listado as $item)
                            <tr>
                                <td>{{ \App\Helpers\Pangea\Fechas::formatearHtml($item->fecha_trazabilidad) }}</td>
                                <td>{{ $item->descripcion_trazabilidad }}</td>
                                <td>{{ $item->usuario->nombres_usuario . ' ' . $item->usuario->apellidos_usuario }}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            @if ($tarea->estado_fk_tarea == \App\EstadosTareas::TAREA_CERRADA)
            <div class="box-footer">
                <div class="text-center">
                    <button type="button" class="btn btn-danger btn-flat" onclick="Tareas.comentarioRechazoTarea({{ $tarea->id_tarea }}, {{ $tarea->padre_fk_tarea }})"><i class="fa fa-remove"></i> Rechazar</button>
                    <button type="button" class="btn btn-success btn-flat" onclick="Tareas.aprobarTarea({{ $tarea->id_tarea }}, {{ $tarea->padre_fk_tarea }})"><i class="fa fa-check"></i> Aprobar</button>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>