@if (count($comentarios))
    @foreach ($comentarios as $comentario)
    <div class="box-comment">
        <!-- User image -->
        <img class="img-circle img-sm" src="{{ asset($comentario->usuario->imagen_usuario) }}" alt="User Image">

        <div class="comment-text">
            <span class="username">
            {{ $comentario->usuario->nombres_usuario}} {{ $comentario->usuario->apellidos_usuarios}}
            <span class="text-muted pull-right">{{ Fechas::formatearHtml($comentario->fecha_comentarioproy)}}</span>
            </span><!-- /.username -->
            {{ $comentario->texto_comentarioproy}}
        </div>
        <!-- /.comment-text -->
    </div>        
    @endforeach
@else
<div class="callout callout-warning">
    <strong>No hay comentarios. Sea el primero en hacerlo...</strong>
</div>
@endif
