<table class="table table-bordered table-striped table-hover" id="grilla-tareas-hito-{{ $hito->id_hito }}">
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Responsable</th>
        <th>Fecha Inicio / Días</th>
        <th>Estado</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @if(count($hito->tareas($hito->id_hito)) > 0)
        @foreach($hito->tareas($hito->id_hito) as $tarea)
            <tr id="fila-tarea-{{ $tarea->id_tarea }}">
                <td>{{ $tarea->nombre_tarea }}</td>
                <td>{{ \App\Tareas::find($tarea->id_tarea)->responsable->nombres_usuario }} {{ \App\Tareas::find($tarea->id_tarea)->responsable->apellidos_usuario }}</td>
                <td>{{ Fechas::formatearHtml($tarea->fecha_inicio_tarea) }} / {{ $tarea->dias_tarea }}</td>
                <td>{{ \App\Tareas::find($tarea->id_tarea)->estado->nombre_et }}</td>
                <td></td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="5">
                No existen tareas para el hito
            </td>
        </tr>
    @endif
    </tbody>
</table>