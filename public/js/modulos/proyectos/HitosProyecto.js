
var HitosProyecto = {

    hitosProyecto : function (proyecto){
        $.ajax({
            url : url_base + '/HitosProyecto/listado/' + proyecto,
            type : 'get',
            data : {},
            dataType : 'html',
            success : function (response) {
                $("#contenedor-hitos").html(response);
            }
        });
    },

    guardarHito : function (form, btn) {
        Pangea.btnProcess(btn, 'Guardando');

        var error = '';
        if(form.nombre_hito.value === ""){
            error += 'Debe ingresar el nombre del hito<br/>';
        }

        if(error !== ""){
            BootModal.danger(error, function () {
                Pangea.btnEndProcess();
            });
        }else{
            $.ajax({
                url : url_base + '/HitosProyecto/guardar',
                type : 'post',
                data : $(form).serializeArray(),
                dataType : 'json',
                success : function (response) {
                    if (response.estado) {
                        BootModal.success(response.mensaje, function () {
                            BootModal.closeAll();
                            HitosProyecto.hitosProyecto(form.id_proyecto.value);
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


    tareasHito : function (hito) {
        $.ajax({
            url : url_base + '/HitosProyecto/tareas/' + hito,
            data : {},
            type : 'get',
            dataType : 'html',
            success : function (response) {
                $("#contenedor-tareas-hito-" + hito).html(response);
            }
        })
    }

};