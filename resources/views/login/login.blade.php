<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Pangea | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('public/template/bower_components/bootstrap/dist/css/bootstrap.min.css?' . uniqid()) }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('public/template/bower_components/font-awesome/css/font-awesome.min.css?' . uniqid()) }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('public/template/bower_components/Ionicons/css/ionicons.min.css?' . uniqid()) }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('public/template/dist/css/AdminLTE.min.css?' . uniqid()) }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('public/template/plugins/iCheck/square/blue.css?' . uniqid()) }}">
  <!-- BootModal -->
  <link rel="stylesheet" href="{{ asset('public/js/plugins/bootstrap3-dialog/dist/css/bootstrap-dialog.min.css?' . uniqid()) }}" />
  <link rel="stylesheet" href="{{ asset('public/css/pangea.css?' . uniqid()) }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <script type="text/javascript">
    var url_base = '{{ url('/') }}';
  </script>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>PANGEA</b></a><br/>
    <small>Gestor de Proyectos</small>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Ingresa tus datos para iniciar sesión</p>
    
    <form role="form">
      <div class="form-group has-feedback">
        <input type="text" id="rut" name="rut" class="form-control" placeholder="RUT, ej.: 12345678-9">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="pass" name="pass" class="form-control" placeholder="Contraseña">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="button" class="btn btn-primary btn-block btn-flat" onclick="Login.validar(this.form, this);">Entrar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>


    <div class="text-right top-spaced">
    <a href="#" onclick="BootModal.open(url_base + '/Usuario/solicitarPassword','Solicitar Nueva Contraseña');">¿Olvidaste tu contraseña?</a><br>
    </div>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{ asset('public/template/bower_components/jquery/dist/jquery.min.js?' . uniqid()) }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('public/template/bower_components/bootstrap/dist/js/bootstrap.min.js?' . uniqid()) }}"></script>
<!-- iCheck -->
<script src="{{ asset('public/template/plugins/iCheck/icheck.min.js?' . uniqid()) }}"></script>
<!-- BootModal -->
<script src="{{ asset('public/js/plugins/bootstrap3-dialog/dist/js/bootstrap-dialog.min.js?' . uniqid()) }}" type="text/javascript"></script>
<script src="{{ asset('public/js/plugins/bootstrap3-dialog/modal.js?' . uniqid()) }}" type="text/javascript"></script>

<script src="{{ asset('public/js/plugins/validaciones.js?' . uniqid()) }}" type="text/javascript"></script>

<!-- js Pangea -->
<script src="{{ asset('public/js/pangea.js?' . uniqid()) }}" type="text/javascript"></script>

<!-- modulo Login -->
<script src="{{ asset('public/js/modulos/login/Login.js?' . uniqid()) }}" type="text/javascript"></script>

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
