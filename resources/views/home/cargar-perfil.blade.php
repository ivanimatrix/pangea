@extends('template-basic') @section('content')
<section class="content-header">
	<h1>
		Cargar Perfil
		<small>Inicio</small>
	</h1>
</section>

<section class="content">
	<div class="box box-primary">
		<div class="box-header with-border">
			<div class="box-title">
				Seleccione perfil con el que desea continuar
			</div>
			<form role="form">
				<div class="box-body">
                    <div class="col-xs-12">
                        <div class="form-group">
                            @foreach ($usuario->perfiles as $item)
                                <div class="radio">
                                    <label>
                                        <input type="radio" class="cargar-perfil" name="perfil" id="perfil_{{ $item->id_perfil }}" value="{{ $item->id_perfil }}"> {{ $item->nombre_perfil}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="text-right">
                        <button type="button" class="btn btn-flat btn-primary" onclick="Usuario.cargarPerfil(this.form, this)">Cargar Perfil</button>
                    </div>
                </div>
			</form>
		</div>
	</div>
</section>
@endsection

@section('js')
    <script src="{{ url('public/js/modulos/usuario/Usuario.js')}}" type="text/javascript"></script>
@endsection