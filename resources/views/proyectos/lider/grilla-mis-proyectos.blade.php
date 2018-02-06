<table class="table table-bordered table-middle table-striped" id="grilla-mis-proyectos">
    <thead>
    <tr>
        <th>Nombre Proyecto</th>
        <th>Estado</th>
        <th>Fecha de Inicio</th>
        <th>% Avance</th>
        <th>% Avance Prioridad</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @if($proyectos)
        @foreach($proyectos as $proyecto)
            <tr>
                <td>{{ $proyecto->nombre_proyecto }}</td>
                <td>{{ $proyecto->estadoProyecto->nombre_ep }}</td>
                <td>{{ Fechas::formatearHtml($proyecto->fecha_inicio_proyecto) }}</td>
                <td>{{ \App\Helpers\Pangea\Proyecto::avance($proyecto->id_proyecto) }}</td>
                <td>{{ \App\Helpers\Pangea\Proyecto::avancePuntual($proyecto->id_proyecto) }}</td>
                <td>
                    <div class="btn-group">
                        @if ($proyecto->estado_fk_proyecto == \App\EstadosProyectos::PROYECTO_CERRADO || $proyecto->estado_fk_proyecto == \App\EstadosProyectos::PROYECTO_FINALIZADO)
                            <a href="{{ url('/Proyectos/reportePdf/' . $proyecto->id_proyecto) }}" target="_blank" class="btn btn-flat btn-primary"><i class="fa fa-file-pdf-o"></i></i> Reporte PDF</a>
                        @else
                            <button type="button" class="btn btn-success btn-flat btn-sm" onclick="window.location.href='{{ url('/Proyectos/detalle/' . $proyecto->id_proyecto) }}';"><i class="fa fa-edit"></i></button>
                        @endif

                    </div>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>