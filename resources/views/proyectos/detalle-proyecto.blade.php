@extends('template')

@section('content')
    <section class="content-header">
        <h1>
            {{ $proyecto->nombre_proyecto }}
            <small>Detalle del proyecto</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12 col-md-4">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <h3 class="profile-username text-center">Información</h3>

                        <p class="text-muted text-center">Datos genéricos</p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Responsable</b> <a class="pull-right">{{ $proyecto->liderProyecto->nombres_usuario }} {{ $proyecto->liderProyecto->apellidos_usuario }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Fecha de Inicio</b> <a class="pull-right">{{ Fechas::formatearHtml($proyecto->fecha_inicio_proyecto) }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Estado</b> <a class="pull-right">{{ $proyecto->estadoProyecto->nombre_ep }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>% Avance</b> <a class="pull-right">%</a>
                            </li>
                        </ul>

                        <a href="#" class="btn btn-primary btn-block" onclick="BootModal.open('{{ url('/ProyectosLider/nuevoRol/' . $proyecto->id_proyecto) }}','Nuevo Rol Proyecto');"><b>Agregar Rol a Proyecto</b></a>

                        <h5>Roles del Proyecto</h5>
                        <ul class="list-group list-group-unbordered" id="contenedor-listado-roles">
                            @if (count($proyecto->rolesProyecto) > 0)
                                @foreach ($proyecto->rolesProyecto as $rol)
                                    <li class="list-group-item">
                                        <b>{{ $rol->nombre_rp }}</b>
                                        <a class="pull-right btn-xs" href="javascript:void(0);" onclick="RolesProyecto.eliminarRolProyecto({{ $rol->proyecto_fk_rp }},{{ $rol->id_rp }})"><i class="fa fa-trash-o"></i></a>
                                        <a class="pull-right btn-xs" href="javascript:void(0);" onclick="RolesProyecto.editarRolProyecto({{ $rol->proyecto_fk_rp }},{{ $rol->id_rp }})"><i class="fa fa-edit"></i></a>
                                        <span class="help-block">{{ $rol->descripcion_rp }}</span>
                                    </li>
                                @endforeach
                            @else
                                <li class="list-group-item">
                                    <b>No se han registrado roles</b>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-md-8">
                <div class="nav-tabs-custom">
                    <!-- TAB NAVIGATION -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active"><a href="#tab1" role="tab" data-toggle="tab">Equipo</a></li>
                        <li><a href="#tab2" role="tab" data-toggle="tab">Actividad</a></li>
                        <li><a href="#tab3" role="tab" data-toggle="tab">Calendario</a></li>
                    </ul>
                    <!-- TAB CONTENT -->
                    <div class="tab-content">
                        <div class="active tab-pane fade in" id="tab1">
                            <div class="row">
                                <div class="col-xs-12 text-right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-flat btn-success" onclick="BootModal.open('{{ url('/UsuariosProyecto/nuevoUsuario/' . $proyecto->id_proyecto) }}','Nuevo Integrante');"><i class="fa fa-user-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="{{ asset(\App\Helpers\Pangea\Usuario::getImagenUsuario(session()->get('id')))}}" alt="user image">
                                        <span class="username">
                                            <a href="#">{{ $proyecto->liderProyecto->nombres_usuario }} {{ $proyecto->liderProyecto->apellidos_usuario }}</a>
                                            {{--<a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>--}}
                                        </span>
                                        <span class="description">Líder de Proyecto</span>
                                    </div>
                                    @if ($proyecto->usuariosProyecto)
                                        @foreach ($proyecto->usuariosProyecto as $usuarioProyecto)
                                            <div class="user-block">
                                                <img class="img-circle img-bordered-sm" src="{{ asset(\App\Helpers\Pangea\Usuario::getImagenUsuario($usuarioProyecto->usuario->id_usuario))}}" alt="user image">
                                                <span class="username">
                                            <a href="#">{{ $usuarioProyecto->usuario->nombres_usuario }} {{ $usuarioProyecto->usuario->apellidos_usuario }}</a>
                                                    {{--<a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>--}}
                                        </span>
                                                @foreach ($usuarioProyecto->roles as $rolUsuario)
                                                    <span class="description">lalas</span>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab2">
                            <h2>Tab2</h2>
                            <p>Lorem ipsum.</p>
                        </div>
                        <div class="tab-pane fade" id="tab3">
                            <h2>Tab3</h2>
                            <p>Lorem ipsum.</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('public/js/modulos/proyectos/Proyectos.js?' . uniqid()) }}" ></script>
    <script type="text/javascript" src="{{ asset('public/js/modulos/proyectos/RolesProyecto.js?' . uniqid()) }}" ></script>
    <script type="text/javascript" src="{{ asset('public/js/modulos/proyectos/UsuariosProyecto.js?' . uniqid()) }}" ></script>
@endsection