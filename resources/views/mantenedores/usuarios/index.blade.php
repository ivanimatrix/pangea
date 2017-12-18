@extends('template')

@section('content')
    <section class="content-header">
        <h1>
            Administración de Usuarios
            <small>Mantenedores</small>
        </h1>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <button type="button" class="btn btn-flat btn-sm btn-primary pull-right" onclick="BootModal.open(url_base + '/MantenedorUsuarios/nuevo','Agregar Nuevo Usuario');">Agregar Nuevo Usuario</button>
            </div>
            <div class="box-body">
                <legend>Listado de Usuarios</legend>
                <div class="table-responsive" id="contenedor-grilla-usuarios"></div>
            </div>
        </div>
    </section>


@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('public/js/plugins/dataTables.js?' . uniqid()) }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/modulos/mantenedores/mantenedor_usuarios.js?' . uniqid()) }}"></script>
    <script type="text/javascript">
        MantenedorUsuarios.cargarGrillaUsuarios();
    </script>
@endsection

