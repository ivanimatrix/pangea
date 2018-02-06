<h1>Pangea :: Gestor de Proyectos</h1>

<h3>Tarea asignada</h3>

<p>Estimado/a {{ $nombre }}:</p>
<p>Se le ha asignado la siguiente tarea del proyecto  <strong>{{ $proyecto }}</strong></p>
<p>Nombre : {{ $tarea }}</p>
<p>Fecha inicio : {{ $fecha_inicio }}</p>
<p>Duración : {{ $dias}} día(s)</p>
<p>Prioridad (1: más baja; 3: más alta) : {{ $prioridad }}</p>

--<br/>
PANGEA Gestor de Proyectos<br/>
{{ date('d-m-Y') }}