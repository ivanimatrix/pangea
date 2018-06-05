<table class="table table-bordered table-striped table-hover small" id="grilla-trazabilidad-tarea">
    <thead>
    <tr>
        <th>Fecha</th>
        <th>Descripción</th>
        <th>Usuario</th>
        <th>Horas Dedicadas</th>
    </tr>
    </thead>
    <tbody>
    @if (count($listado))
        @foreach ($listado as $item)
            <tr>
                <td>{{ \App\Helpers\Pangea\Fechas::formatearHtml($item->fecha_trazabilidad) }}</td>
                <td>{{ $item->descripcion_trazabilidad }}</td>
                <td>{{ $item->usuario->nombres_usuario . ' ' . $item->usuario->apellidos_usuario }}</td>
                <td class="text-right">{{ $item->horas_dedicadas_trazabilidad }}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
<div class="col-xs-12">
    <div class="row">
        <div class="callout callout-info text-right">
            Total horas dedicadas : <label class="label bg-aqua-active">{{ $total_horas_dedicadas }}</label>
        </div>
    </div>
</div>