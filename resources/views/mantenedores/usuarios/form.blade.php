<div class="row">
	<div class="col-xs-12">
		<div class="box box-solid">
			<form role="form" class="form-horizontal">
				<input type="hidden" name="id_usuario" id="id_usuario" @if($usuario) value="{{ $usuario->id_usuario }}" @else value="0" @endif
				/>
				<div class="box-header with-border">
					<div class="text-right">
						<span class="help-block small label bg-primary">(*) son datos obligatorios</span>
					</div>
				</div>
				<div class="box-body">

					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-6">
							<div class="form-group">
								<label class="col-xs-12">RUT (*)</label>

								<div class="col-xs-12">
									<span class="col-xs-12 label bg-red label-square mensajes-validacion" id="mensaje-rut"></span>
									<input type="text" class="form-control" name="rut" id="rut" @if($usuario) value="{{ $usuario->rut_usuario }}" @endif />
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-12">Nombres (*)</label>
								<div class="col-xs-12">
									<span class="col-xs-12 label bg-red label-square mensajes-validacion" id="mensaje-nombres"></span>
									<input type="text" class="form-control" name="nombres" id="nombres" @if($usuario) value="{{ $usuario->nombres_usuario }}"
											@endif />
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-12">Apellidos (*)</label>
								<div class="col-xs-12">
									<span class="col-xs-12 label bg-red label-square mensajes-validacion" id="mensaje-apellidos"></span>
									<input type="text" class="form-control" name="apellidos" id="apellidos" @if($usuario) value="{{ $usuario->apellidos_usuario }}"
											@endif />
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-12">Email (*)</label>
								<div class="col-xs-12">
									<span class="col-xs-12 label bg-red label-square mensajes-validacion" id="mensaje-email"></span>
									<input type="email" class="form-control" name="email" id="email" @if($usuario) value="{{ $usuario->email_usuario }}" @endif
									/>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-6">
							<div class="form-group">
								<label class="col-xs-12">Perfiles (*)</label>
								<div class="col-xs-12">
									<span class="col-xs-12 label bg-red label-square mensajes-validacion" id="mensaje-perfiles"></span>
									@foreach($perfiles as $perfil)
										<div class="checkbox">
											<label>
												<input type="checkbox" name="perfiles[]" class="perfiles" @if(isset($usuario->pu) and in_array($perfil->id_perfil, $usuario->pu)) checked @endif value="{{ $perfil->id_perfil }}" /> {{ $perfil->nombre_perfil
									}}
											</label>
										</div>
									@endforeach
								</div>
							</div>
						</div>
					</div>







				</div>
				<div class="box-footer">
					<div class="text-right">
						<button type="button" class="btn btn-flat btn-primary" onclick="MantenedorUsuarios.guardarUsuario(this.form, this)">Guardar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>