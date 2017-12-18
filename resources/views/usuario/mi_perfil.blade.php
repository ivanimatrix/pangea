@extends('template')

@section('content')
    <section class="content-header">
        <h1>
            Mi Perfil
            <small>Usuario</small>
        </h1>

    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12 col-md-4">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="{{ asset(session()->get('avatar')) }}" alt="User profile picture">

                        <h3 class="profile-username text-center">
                            {{ $usuario->nombres_usuario }} {{ $usuario->apellidos_usuario }}
                        </h3>

                        <p class="text-muted text-center">Registrado el {{ \App\Helpers\Pangea\Fechas::formatearHtml($usuario->registro_usuario) }}</p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>RUN</b> <a class="pull-right">{{ $usuario->rut_usuario }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Email</b> <a class="pull-right">{{ $usuario->email_usuario }}</a>
                            </li>
                        </ul>

                        <div class="text-center">
                            <div class="btn-group">
                                <a href="javascript:void(0);" onclick="BootModal.open(url_base + '/Usuario/actualizarMisDatos','Actualizar Mis Datos');" class="btn btn-primary "><b>Actualizar mis datos</b></a>
                                <a href="javascript:void(0);" onclick="BootModal.open(url_base + '/Usuario/actualizarMiPassword','Actualizar Mi Contraseña');" class="btn btn-primary"><b>Actualizar contraseña</b></a>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Información adicional</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <strong><i class="fa fa-book margin-r-5"></i> Perfiles</strong>

                        <p class="text-muted">
                            B.S. in Computer Science from the University of Tennessee at Knoxville
                        </p>

                        <hr>

                        <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

                        <p class="text-muted">Malibu, California</p>

                        <hr>

                        <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

                        <p>
                            <span class="label label-danger">UI Design</span>
                            <span class="label label-success">Coding</span>
                            <span class="label label-info">Javascript</span>
                            <span class="label label-warning">PHP</span>
                            <span class="label label-primary">Node.js</span>
                        </p>

                        <hr>

                        <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <div class="col-xs-12 col-md-8">


                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div class="box-title">Mi actividad</div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('js')
    <script src="{{ asset('public/js/modulos/usuario/Usuario.js?' . uniqid()) }}" type="text/javascript"></script>
@endsection