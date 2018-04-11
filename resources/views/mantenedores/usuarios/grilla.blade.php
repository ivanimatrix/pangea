<table class="table table-striped table-bordered datatables table-middle" id="grilla-usuarios">
    <thead>
    <tr>
        <th>RUT</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Email</th>
        <th class="text-center">Avatar</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @if($usuarios)
        @foreach($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->rut_usuario }}</td>
                <td>{{ $usuario->nombres_usuario }}</td>
                <td>{{ $usuario->apellidos_usuario }}</td>
                <td>{{ $usuario->email_usuario }}</td>
                <td>
                    <img class="img-responsive center-block" src="{{ url(Usuario::getImagenUsuario($usuario->id_usuario)) }}" style="height: 36px" />
                </td>
                <td class="text-center">
                    <div class="btn-group">
                        @if($usuario->id_usuario != session()->get('id'))
                            <button type="button" class="btn btn-flat btn-success" onclick="MantenedorUsuarios.cargarPerfilUsuario({{ $usuario->id_usuario }})"><i class="fa fa-user"></i></button>
                            <button type="button" class="btn btn-flat btn-success" onclick="BootModal.open(url_base + '/MantenedorUsuarios/editar/{{ $usuario->id_usuario }}','Editar Usuario');"><i class="fa fa-edit"></i></button>
                            <button type="button" class="btn btn-flat btn-danger" onclick=""
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>