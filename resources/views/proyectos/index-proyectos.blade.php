
@extends('template')

@section('content')
    <section class="content-header">
        <h1>
            Listado de Proyectos
            <small>Proyectos</small>
        </h1>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <button type="button" class="btn btn-flat btn-primary pull-right" onclick="window.location.href='{{ url('/Proyectos/nuevo') }}'">Nuevo Proyecto</button>
            </div>
            <div class="box-body">
                <div class="table-responsive" id="contenedor-listado-proyectos"></div>
            </div>
        </div>
    </section>
@endsection


@section('js')
    <script src="{{ url('public/js/plugins/dataTables.js') }}" type="text/javascript"></script>
    <script src="{{ url('public/js/modulos/proyectos/Proyectos.js?' . uniqid()) }}" type="text/javascript"></script>
    <script type="text/javascript">
        Proyectos.listadoProyectos();
    </script>
@endsection
