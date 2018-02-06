<table class="table table-bordered table-striped table-hover table-condensed" id="grilla-tareas-{{ $grilla }}">
    <thead>
        <tr>
            <th>Nombre Tarea</th>
            <th>Proyecto</th>
            <th>Fecha Inicio</th>
            <th>Días</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @if (count($tareas) > 0) 
            @foreach ($tareas as $tarea)
            <tr>
                <td>{{ $tarea->nombre_tarea }}</td>
                <td>{{ $tarea->hito->proyecto->nombre_proyecto }}</td>
                <td>{{ \App\Helpers\Pangea\Fechas::formatearHtml($tarea->fecha_inicio_tarea) }}</td>
                <td>{{ $tarea->dias_tarea }}</td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-flat btn-success" onclick="window.location.href='{{ url('/Tareas/desarrollarTarea/' . $tarea->id_tarea) }}';"><i class="fa fa-edit"></i></button>
                    </div>
                </td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>