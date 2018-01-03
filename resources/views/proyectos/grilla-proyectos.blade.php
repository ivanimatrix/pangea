<table class="table table-bordered table-striped table-hover" id="grilla-proyectos">
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
                        <button type="button" class="btn btn-success btn-flat" onclick="window.location.href='{{ url('/Proyectos/editar/' . $proyecto->id_proyecto) }}'"><i class="fa fa-edit"></i></button>
                    </div>
                </td>
            </tr>
        @endforeach
    @endif

    </tbody>
</table>
