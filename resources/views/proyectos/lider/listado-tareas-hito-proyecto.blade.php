<table class="table table-bordered table-striped table-hover table-middle" id="grilla-tareas-hito-{{ $hito->id_hito }}">
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Fecha Inicio / Días</th>
        <th>Estado</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @if(count($hito->tareas) > 0)
        @foreach($hito->tareas as $tarea)
            <tr id="fila-tarea-{{ $tarea->id_tarea }}">
                <td>
                    <p>{{ $tarea->nombre_tarea }}</p>
                    <span class="small text-bold">Responsable:</span>
                    <span class="help-block">{{ \App\Tareas::find($tarea->id_tarea)->responsable->nombres_usuario }} {{ \App\Tareas::find($tarea->id_tarea)->responsable->apellidos_usuario }}</span>
                </td>
                <td>{{ Fechas::formatearHtml($tarea->fecha_inicio_tarea) }} / {{ $tarea->dias_tarea }}</td>
                <td>{{ \App\Tareas::find($tarea->id_tarea)->estado->nombre_et }}</td>
                <td class="text-center">
                    <div class="btn-group-vertical">
                        <button type="button" class="btn btn-flat btn-primary btn-sm" onclick="BootModal.open('{{ url('/Tareas/verTarea/' . $tarea->id_tarea) }}','Ver Tarea');"><i class="fa fa-eye"></i></button>
                        @if ($tarea->estado_fk_tarea == \App\EstadosTareas::TAREA_CREADA or $tarea->estado_fk_tarea == \App\EstadosTareas::TAREA_EN_DESARROLLO)
                        <button type="button" class="btn btn-flat btn-success btn-sm" onclick="BootModal.open('{{ url('/TareasProyecto/editar/'.$tarea->hito->proyecto->id_proyecto.'/2/' . $tarea->hito->id_hito . '/' . $tarea->id_tarea) }}','Nueva Tarea');"><i class="fa fa-edit"></i></button>
                        @endif
                        <button type="button" class="btn btn-flat btn-danger btn-sm" onclick="Tareas.borrarTarea({{ $tarea->id_tarea }}, {{ $hito->id_hito }})"><i class="fa fa-trash-o"></i></button>
                    </div>
                </td>
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