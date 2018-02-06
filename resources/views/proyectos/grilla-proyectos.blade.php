<table class="table table-bordered table-striped table-hover table-middle" id="grilla-proyectos">
    <thead>
    <tr>
        <th>Nombre Proyecto</th>
        <th>Lider encargado</th>
        <th>Fecha Inicio</th>
        <th>Estado</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @if ($proyectos)
        @foreach($proyectos as $proyecto)
            <tr>
                <td class="text-center">{{ $proyecto->nombre_proyecto }}</td>
                <td class="text-center">{{ $proyecto->liderProyecto->nombres_usuario }} {{ $proyecto->liderProyecto->apellidos_usuario }}</td>
                <td class="text-center">{{ Fechas::formatearHtml($proyecto->fecha_inicio_proyecto) }}</td>
                <td class="text-center">{{ $proyecto->estadoProyecto->nombre_ep }}</td>
                <td class="text-center">
                    <div class="btn-group">
                        @if ($proyecto->estado_fk_proyecto == \App\EstadosProyectos::PROYECTO_CERRADO or $proyecto->estado_fk_proyecto == \App\EstadosProyectos::PROYECTO_FINALIZADO)
                            <a href="{{ url('/Proyectos/reportePdf/' . $proyecto->id_proyecto) }}" target="_blank" class="btn btn-flat btn-primary"><i class="fa fa-file-pdf-o"></i></i> Reporte PDF</a>
                            @if ($proyecto->estado_fk_proyecto == \App\EstadosProyectos::PROYECTO_CERRADO)
                                <button type="button" class="btn btn-flat btn-success" title="FINALIZAR PROYECTO" onclick="Proyectos.finalizar({{ $proyecto->id_proyecto }});"><i class="fa fa-check-square"></i></button>
                            @endif
                        @else
                            <button type="button" class="btn btn-success btn-flat" title="VER PROYECTO" onclick="window.location.href='{{ url('/Proyectos/detalle/' . $proyecto->id_proyecto) }}';"><i class="fa fa-search"></i></button>
                            <button type="button" class="btn btn-success btn-flat" title="EDITAR" onclick="BootModal.open('{{ url('/Proyectos/editar/' . $proyecto->id_proyecto) }}','Editar Proyecto');"><i class="fa fa-edit"></i></button>
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
    @endif

    </tbody>
</table>
