@extends('template')

@section('content')
<section class="content-header">
    <h1>
        Bandeja de Trabajo : Mis Tareas
        <small>Tareas</small>
    </h1>
</section>

<section class="content">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#asignadas" data-toggle="tab">Asignadas</a>
            </li>
            <li>
                <a href="#en_desarrollo" data-toggle="tab">En Desarrollo</a>
            </li>
            <li>
                <a href="#rechazadas" data-toggle="tab">Rechazadas</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="asignadas">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-responsive" id="contenedor-tareas-creadas"></div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="en_desarrollo">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-responsive" id="contenedor-tareas-en_desarrollo"></div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="rechazadas">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-responsive" id="contenedor-tareas-rechazadas"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
    <script src="{{ url('public/js/plugins/dataTables.js') }}" type="text/javascript"></script>
    <script src="{{ url('public/js/modulos/tareas/Tareas.js?' . uniqid()) }}" type="text/javascript"></script>
    <script type="text/javascript">
        Tareas.listadoMisTareas('creadas');
        Tareas.listadoMisTareas('en_desarrollo');
        Tareas.listadoMisTareas('rechazadas');
    </script>
@endsection