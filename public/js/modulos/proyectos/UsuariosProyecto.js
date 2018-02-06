
var UsuariosProyecto = {

    guardarUsuarioProyecto : function (form, btn){
        Pangea.btnProcess(btn, 'Guardando');
        var error = "";
        if(form.id_usuario.value === "0" && form.integrante.value === ""){
            error += "Debe seleccionar al integrante<br/>";
        }
        if($('.roles_usuario:checked').length == 0){
            error += "Debe seleccionar al menos un rol para el integrante <br/>"
        }

        if (error !== "") {
            BootModal.danger(error, function () {
                Pangea.btnEndProcess();
            });
        }else{
            $.ajax({
                url : url_base + '/UsuariosProyecto/guardar',
                data : $(form).serializeArray(),
                dataType : 'json',
                type : 'post',
                success : function (response) {
                    if (response.estado) {
                        BootModal.success(response.mensaje, function () {
                            BootModal.closeAll();
                            UsuariosProyecto.listadoUsuariosProyecto(form.proyecto.value);
                        });
                    } else {
                        BootModal.danger(response.mensaje, function () {
                            Pangea.btnEndProcess();
                        });
                    }
                },
                error : function () {
                    BootModal.danger(Pangea.msg_error, function () {
                        Pangea.btnEndProcess();
                    });
                }
            })
        }
    },

    listadoUsuariosProyecto : function (proyecto) {
        $.ajax({
            url : url_base + '/UsuariosProyecto/listado/' + proyecto,
            data : {},
            dataType : 'html',
            type : 'get',
            success : function (response){
                $("#contenedor-integrantes").html(response);
            }
        })
    }
};