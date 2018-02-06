<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Gestor de Proyectos" />
    <title>Pangea - Gestor de Proyectos</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('public/template/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('public/template/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('public/template/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/template/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('public/template/dist/css/skins/_all-skins.min.css') }}">

    <!-- BootModal -->
    <link rel="stylesheet" href="{{ asset('public/js/plugins/bootstrap3-dialog/dist/css/bootstrap-dialog.min.css?' . uniqid()) }}" />
    <link rel="stylesheet" href="{{ asset('public/css/pangea.css?' . uniqid()) }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript">
        var url_base = '{{ url('/') }}';
    </script>

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue">
<!-- Site wrapper -->
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>Pgea</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>PANGEA</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                   {{-- <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="label label-success">4</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 4 messages</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li><!-- start message -->
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                            </div>
                                            <h4>
                                                Support Team
                                                <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                    <!-- end message -->
                                </ul>
                            </li>
                            <li class="footer"><a href="#">See All Messages</a></li>
                        </ul>
                    </li>--}}
                    <!-- Notifications: style can be found in dropdown.less -->
                    {{--<li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning">10</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 10 notifications</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer"><a href="#">View all</a></li>
                        </ul>
                    </li>--}}
                    <!-- Tasks: style can be found in dropdown.less -->
                    {{--<li class="dropdown tasks-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-flag-o"></i>
                            <span class="label label-danger">9</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 9 tasks</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li><!-- Task item -->
                                        <a href="#">
                                            <h3>
                                                Design some buttons
                                                <small class="pull-right">20%</small>
                                            </h3>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                                                     aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">20% Complete</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <!-- end task item -->
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="#">View all tasks</a>
                            </li>
                        </ul>
                    </li>--}}
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset(Usuario::getImagenUsuario(session()->get('id'))) }}" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{ session()->get('nombres') }} {{ session()->get('apellidos') }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{ asset(Usuario::getImagenUsuario(session()->get('id'))) }}" class="img-circle" alt="User Image">

                                <p>
                                    {{ session()->get('nombres') }} {{ session()->get('apellidos') }}
                                    {{--<small>Member since Nov. 2012</small>--}}
                                </p>
                            </li>

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="btn-group btn-group-justified">
                                    <a href="{{ url('/Usuario/miPerfil') }}" class="btn btn-default btn-flat">Mi Cuenta</a>
                                    @if (count(Usuario::getPerfiles(session()->get('id'))) > 1)
                                        <a href="{{ url('/Home/cargarPerfil') }}" class="btn btn-default btn-flat">Perfiles</a>
                                    @endif
                                    @if(session()->get('id_respaldo'))
                                        <a href="javascript:void(0);" class="btn btn-default btn-flat" onclick="MantenedorUsuarios.cerrarPerfilUsuario();">Volver</a>
                                    @else
                                        <a href="{{ url('/Login/logout') }}" class="btn btn-default btn-flat">Salir</a>
                                    @endif
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel" style=" height:60px">
                {{--  <div class="pull-left image">
                    <img src="{{ asset(session()->get('avatar')) }}" class="img-circle" alt="User Image">
                </div>  --}}
                <div class="pull-left info" style="left:5px;">
                    <p>{{ session()->get('nombres') }} {{ session()->get('apellidos') }}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ Usuario::getPerfilActual(session()->get('perfil'))}}</a>
                </div>
            </div>

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MENÚ PRINCIPAL</li>
                <li>
                    <a href="{{ url('/Home/dashboard') }}">
                        <i class="fa fa-dashboard"></i> <span>Inicio</span>
                    </a>
                </li>
                @include('menu.menu_principal')
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 0.0.1
        </div>
        <strong>{{ env('APP_NAME') }}</strong> Gestor de Proyectos
    </footer>

    <!-- Add the sidebar's background. This div must be placed
        immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('public/template/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('public/template/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('public/template/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('public/template/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('public/template/dist/js/adminlte.min.js') }}"></script>
<!-- BootModal -->
<script src="{{ asset('public/js/plugins/bootstrap3-dialog/dist/js/bootstrap-dialog.min.js?' . uniqid()) }}" type="text/javascript"></script>
<script src="{{ asset('public/js/plugins/bootstrap3-dialog/modal.js?' . uniqid()) }}" type="text/javascript"></script>

<script src="{{ asset('public/js/plugins/validaciones.js?' . uniqid()) }}" type="text/javascript"></script>

<!-- js Pangea -->
<script src="{{ asset('public/js/pangea.js?' . uniqid()) }}" type="text/javascript"></script>
@if(session()->get('id_respaldo'))
    <script type="text/javascript" src="{{ asset('public/js/modulos/mantenedores/mantenedor_usuarios.js?' . uniqid()) }}"></script>
@endif
<script>
    $(document).ready(function () {
        $('.sidebar-menu').tree()
    })
</script>

@yield('js')
</body>
</html>
