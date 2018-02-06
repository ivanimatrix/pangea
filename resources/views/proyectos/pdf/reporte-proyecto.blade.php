<html>
<style>
    @page {
	header: page-header;
	footer: page-footer;
}
</style>

<title>Reporte Proyecto</title>

<body style="font-size:14px; font-family: Arial, Helvetiva, sans-serif;">
    <htmlpageheader name="page-header" >
        <div style="width:100%;border-bottom:1px solid #000;text-align:right;font-size:10px">Reporte Proyecto - {{ date('d/m/Y')}}</div>
    </htmlpageheader>
    

    <h1 style="text-align:center">{{ $proyecto->nombre_proyecto }}</h1>

    <table style="width:100%">
        <thead>
            <tr>
                <td style="width:50%; text-align:center"><strong>Responsable</strong></td>
                <td style="width:50%; text-align:center"><strong>Fecha de Inicio</strong></td>
            </tr>
            <tr>
                <td style="width:50%; text-align:center">{{ $proyecto->liderProyecto->nombres_usuario }} {{ $proyecto->liderProyecto->apellidos_usuario }}</td>
                <td style="width:50%; text-align:center">{{ \App\Helpers\Pangea\Fechas::formatearHtml($proyecto->fecha_inicio_proyecto) }}</td>
            </tr>
        </thead>
    </table>

    <h3 style="border-bottom:1px solid #000">Descripción</h3>
    <p>{{ $proyecto->descripcion_proyecto }}</p>

    <h3 style="border-bottom:1px solid #000">Equipo</h3>
    <ul>
        @foreach ($proyecto->usuariosProyecto as $integrante)
        <li>{{ $integrante->usuario->nombres_usuario }} {{ $integrante->usuario->apellidos_usuario }}</li>
        @endforeach
    </ul>

    <h3 style="border-bottom:1px solid #000">Planificación</h3>
    @if (count($proyecto->hitosProyecto) > 0)
        @foreach ($proyecto->hitosProyecto as $hito)
            <table style="border:1px solid #000; width:100%;margin-bottom:10px" cellspacing="0" cellpadding="5">
                <thead>
                    <tr>
                        <th style="border:1px solid #000;text-align:left" colspan="5">{{ $hito->nombre_hito }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="border:1px solid #000;text-align:left" colspan="5">{{ $hito->descripcion_hito }}</td>
                    </tr>
                </tbody>
                <thead>
                    <tr>
                        <th style="border:1px solid #000;text-align:left">Tarea/Actividad</th>
                        <th style="border:1px solid #000;text-align:left">Fecha de Inicio</th>
                        <th style="border:1px solid #000;text-align:left">Duración (días)</th>
                        <th style="border:1px solid #000;text-align:left">Responsable</th>
                        <th style="border:1px solid #000;text-align:left">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($hito->tareas) > 0)
                        @foreach ($hito->tareas as $tarea)
                            <tr>
                                <td style="vertical-align:middle;border:0.5px solid #000">{{ $tarea->nombre_tarea }}</td>
                                <td style="vertical-align:middle;border:0.5px solid #000;text-align:center">{{ $tarea->fecha_inicio_tarea }}</td>
                                <td style="vertical-align:middle;border:0.5px solid #000;text-align:center">{{ $tarea->dias_tarea }}</td>
                                <td style="vertical-align:middle;border:0.5px solid #000;text-align:center">{{ $tarea->responsable->nombres_usuario }} {{ $tarea->responsable->apellidos_usuario }}</td>
                                <td style="vertical-align:middle;border:0.5px solid #000;text-align:center">{{ $tarea->estado->nombre_et }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        @endforeach
    @endif

    <htmlpagefooter name="page-footer">
        <div style="border-top:1px solid #000;font-size:10px">
            <div style="width:50%;text-align:left;float:left">
                <strong>Pangea</strong> Gestor de Proyectos
            </div>
            <div style="width:50%;text-align:right;float:right">
                {PAGENO}
            </div>
        </div>
    </htmlpagefooter>
</body>



</html>