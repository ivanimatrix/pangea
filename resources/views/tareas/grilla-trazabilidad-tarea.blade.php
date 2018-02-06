<table class="table table-bordered table-striped table-hover" id="grilla-trazabilidad-tarea">
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