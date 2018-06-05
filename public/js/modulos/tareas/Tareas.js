
var Tareas = {

    listadoMisTareas: function (estado) {
        $.ajax({
            url: url_base + '/Tareas/listarMisTareas',
            data: { estado: estado },
            dataType: 'html',
            type: 'post',
            success: function (response) {
                $("#contenedor-tareas-" + estado).html(response);
                Dtables.initTable('grilla-tareas-' + estado);
            }
        });
    },


    trazabilidadTarea: function (tarea) {
        $.ajax({
            url: url_base + '/Tareas/trazabilidad',
            data: { tarea: tarea },
            dataType: 'html',
            type: 'post',
            success: function (response) {
                $("#contenedor-trazabilidad-tarea").html(response);
                Dtables.initTable('grilla-trazabilidad-tarea');
            }
        });
    },


    registrarAvance: function (form, btn) {
        Pangea.btnProcess(btn, 'Registrando');

        var error = '';
        if (form.texto_avance.value === "") {
            error += 'Debe escribir el registro de su avance<br/>';
        }

        if (isNaN(form.horas_dedicadas.value) || form.horas_dedicadas.value === "") {
            error += 'Debe indicar las horas dedicas<br/>';
        }

        if (error !== "") {
            BootModal.danger(error, function () {
                Pangea.btnEndProcess();
            });
        } else {
            $.ajax({
                url: url_base + '/Tareas/registrarAvance',
                data: $(form).serializeArray(),
                type: 'post',
                dataType: 'json',
                success: function (response) {
                    if (response.estado) {
                        BootModal.success(response.mensaje, function () {
                            Tareas.trazabilidadTarea(form.id_tarea_avance.value);
                            Pangea.btnEndProcess();
                            Tareas.cerrarTarea(form.id_tarea_avance.value);
                        });
                    } else {
                        BootModal.danger(response.mensaje, function () {
                            Pangea.btnEndProcess();
                        });
                    }
                },
                error: function () {
                    BootModal.danger(Pangea.msg_error, function () {
                        Pangea.btnEndProcess();
                    });
                }
            });
        }
    },

    cerrarTarea: function (tarea) {
        BootModal.confirm('¿Desea cerrar la tarea?', function () {
            $.ajax({
                url : url_base + '/Tareas/cerrarTarea',
                data : {tarea : tarea},
                dataType : 'json',
                type : 'post',
                success : function (response) {
                    if (response.estado) {
                        BootModal.success(response.mensaje, function() {
                            window.location.href = url_base + response.redirect;
                        })
                    } else {
                        BootModal.danger(response.mensaje)
                    }
                },
                error : function () {
                    BootModal.danger(Pangea.msg_error);
                }
            })
        });
    },

    aprobarTarea : function(tarea, hito) {
        BootModal.confirm('¿Desea aprobar la tarea?', function () {
            $.ajax({
                url : url_base + '/Tareas/aprobar',
                data : {tarea:tarea},
                type : 'post',
                dataType : 'json',
                success : function (response) {
                    if (response.estado) {
                        BootModal.success(response.mensaje, function () {
                            BootModal.closeAll();
                            HitosProyecto.tareasHito(hito);
                        });
                    } else {
                        BootModal.danger(response.mensaje);
                    }
                },
                error : function () {
                    BootModal.danger(Pangea.msg_error);
                }
            });
        });

    },

    rechazarTarea : function(form, btn) {
        Pangea.btnProcess(btn, 'Rechazando');

        var error = "";
        if (form.comentario_rechazo_tarea.value == "") {
            error += 'Debe ingresar el comentario de rechazo <br/>';
        }

        if (error !== "") {
            BootModal.danger(error, function (){
                Pangea.btnEndProcess();
            });
        } else {
            $.ajax({
                url : url_base + '/Tareas/rechazar',
                data : { tarea : form.id_tarea_rechazo.value, comentario_rechazo : form.comentario_rechazo_tarea.value },
                type : 'post',
                dataType : 'json',
                success : function (response) {
                    if (response.estado) {
                        BootModal.success(response.mensaje, function () {
                            BootModal.closeAll();
                            HitosProyecto.tareasHito(form.id_hito_tarea.value);
                        });
                    } else {
                        BootModal.danger(response.mensaje);
                    }
                },
                error : function () {
                    BootModal.danger(Pangea.msg_error);
                }
            });
        }

    },

    comentarioRechazoTarea : function(tarea, hito) {
        BootModal.confirm('¿Desea rechazar la tarea?', function () {
            BootModal.open(url_base + '/Tareas/comentarioRechazo/' + tarea, 'Registrar rechazo');
        });
    },


    borrarTarea : function (tarea, hito) {
        BootModal.danger('¿Desea borrar esta tarea?', function(){
            $.ajax({
                url : url_base + '/TareasProyecto/borrarTarea',
                data : {tarea:tarea},
                dataType : 'json',
                type : 'post',
                success : function(response) {
                    if (response.correcto) {
                        BootModal.success(response.mensaje, function() {
                            HitosProyecto.tareasHito(hito);
                        });
                    } else {
                        BootModal.danger(response.mensaje, function () {

                        });
                    }
                }
            })
        });
    }

};