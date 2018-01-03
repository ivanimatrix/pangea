<table class="table table-bordered table-middle table-striped" id="grilla-mis-proyectos">
    <thead>
    <tr>
        <th>Nombre Proyecto</th>
        <th>Estado</th>
        <th>Fecha de Inicio</th>
        <th>% Avance</th>
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
                <td></td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-success btn-flat btn-sm" onclick="window.location.href='{{ url('/Proyectos/detalle/' . $proyecto->id_proyecto) }}';"><i class="fa fa-edit"></i></button>
                    </div>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>