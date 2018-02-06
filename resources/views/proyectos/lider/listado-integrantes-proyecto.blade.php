@if ($proyecto->usuariosProyecto)
    @foreach ($proyecto->usuariosProyecto as $usuarioProyecto)
        <div class="post" style="padding-bottom: 0">
            <div class="user-block">
                <img class="img-circle img-bordered-sm" src="{{ asset(\App\Helpers\Pangea\Usuario::getImagenUsuario($usuarioProyecto->usuario_fk_up))}}" alt="user image">
                <span class="username">
                    <a href="javascript:void(0);" onclick="BootModal.open('{{ url('/UsuariosProyecto/editarUsuario/' . $proyecto->id_proyecto.'/'.$usuarioProyecto->id_up) }}','Editar Integrante {{ $usuarioProyecto->usuario->nombres_usuario }} {{ $usuarioProyecto->usuario->apellidos_usuario }}');">{{ $usuarioProyecto->usuario->nombres_usuario }} {{ $usuarioProyecto->usuario->apellidos_usuario }}</a>
                    <a href="#" class="pull-right btn-box-tool"><i class="fa fa-remove"></i></a>
                    <br/>
                    @foreach ($usuarioProyecto->roles as $rolUsuario)
                        <span class="label label-primary">{{ $rolUsuario->nombre_rp }}</span>
                    @endforeach
                </span>
            </div>
        </div>
    @endforeach
@endif