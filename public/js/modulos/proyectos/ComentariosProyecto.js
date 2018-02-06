
var ComentariosProyecto = {

    
    listadoComentariosProyecto: function (proyecto) {
        $.ajax({
            url: url_base + '/ComentariosProyecto/listado/' + proyecto,
            type: 'get',
            dataType: 'html',
            data: {},
            success: function (response) {
                $('#contenedor-comentarios-proyecto').html(response);
            }
        });
    },

	registrarComentario: function (event, form) {
		if (event.keyCode === 13) {
			if ($("#texto_comentario").val() !== "") {
				
				$.ajax({
					url: url_base + '/ComentariosProyecto/registrarComentario',
					type: 'post',
					dataType: 'json',
					data: {proyecto : $("#comentario_proyecto").val(), texto : $("#texto_comentario").val()},
					success: function (response) {
						if (response.estado) {
							ComentariosProyecto.listadoComentariosProyecto($("#comentario_proyecto").val());
						} else {
							BootModal.danger(response.mensaje);
						}
					},
					error: function () {
						BootModal.danger('Error interno. Intente nuevamente, o comuníquese con Mesa de Ayuda');
					}
				});
			} else {
				BootModal.danger('Debe ingresar un texto para comentar');
			}
           
        } 
    }

}