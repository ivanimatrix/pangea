<div class="row">
    <div class="col-xs-12">
        <button type="button" class="btn btn-flat btn-success pull-right" onclick="BootModal.open('{{ url('/HitosProyecto/nuevo/' . $proyecto->id_proyecto) }}', 'Nuevo Hito');">Nuevo Hito</button>
    </div>
</div>

<div class="box box-solid top-spaced">
    
    <!-- /.box-header -->
    <div class="box-body no-padding">
        @if (count($proyecto->hitosProyecto) > 0)
            <div class="box-group" id="hitos-acordeon">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                @foreach ($proyecto->hitosProyecto as $hito)
                    <div class="panel box box-primary">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#hitos-acordeon" href="#hito-{{ $hito->id_hito }}">
                                    {{ $hito->nombre_hito }}
                                </a>
                            </h4>
                            <div class="btn-group pull-right ">
                                    <div class="dropdown">
                                        <button class="btn btn-primary btn-sm btn-flat dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            Opciones
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                                            <li><a href="javascript:void(0)" onclick="BootModal.open('{{ url('/HitosProyecto/editar/' . $proyecto->id_proyecto . '/' . $hito->id_hito) }}', 'Editar Hito');">Editar</a></li>
                                            <li><a href="javascript:void(0)" onclick="BootModal.open('{{ url('/TareasProyecto/nuevo/'.$proyecto->id_proyecto.'/2/' . $hito->id_hito) }}','Nueva Tarea');">Nueva Tarea</a></li>
                                        </ul>
                                    </div>

                            </div>
                        </div>
                        <div id="hito-{{ $hito->id_hito }}" class="panel-collapse collapse">
                            @if (!empty($hito->descripcion_hito))
                                <div class="box-body small">
                                    <span class="help-block">{{ $hito->descripcion_hito }}</span>
                                </div>
                            @endif
                            <div class="box-footer">
                                <div id="contenedor-tareas-hito-{{ $hito->id_hito }}" class="table-responsive small">
                                    @include('proyectos.lider.listado-tareas-hito-proyecto')
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="callout callout-info">
                <i class="icon fa fa-info-circle"></i> No existen hitos ingresados para el proyecto.
            </div>
        @endif
    </div>
    <!-- /.box-body -->
</div>