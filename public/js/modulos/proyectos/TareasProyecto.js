
var TareasProyecto = {


    guardarTarea : function (form, btn) {
        Pangea.btnProcess(btn, 'Guardando');

        var error = '';

        if (form.nombre_tarea.value == "") {
            error += 'Debe ingresar el nombre de la tarea <br/>';
        }
        if (form.responsable_tarea.value == "") {
            error += 'Debe seleccionar el responsable de la tarea <br/>';
        }
        if (form.fecha_inicio_tarea.value == "") {
            error += 'Debe indicar la fecha de inicio de la tarea <br/>';
        }

        if(form.dias_tarea.value == "") {
            error += 'Debe indicar los días de desarrollo de la tarea <br/>';
        }

        if(error !== ""){
            BootModal.danger(error, function () {
                Pangea.btnEndProcess();
            });
        }else{
            $.ajax({
                url : url_base + '/TareasProyecto/guardar',
                data : $(form).serializeArray(),
                type : 'post',
                dataType : 'json',
                success : function (response) {
                    if (response.estado) {
                        BootModal.success(response.mensaje, function () {
                            if (form.tipo_padre.value == 2) {
                                var hito = form.id_padre.value;
                                HitosProyecto.tareasHito(hito);

                            }

                            BootModal.closeAll()
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
            });
        }

    }
};