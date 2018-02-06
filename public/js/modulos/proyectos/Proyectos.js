

var Proyectos = {

    num_hitos_agregados : 0,

    activarContenedorHitos :  function(item){
        if($(item).is(':checked')){
            $('#contenedor-hitos-proyecto').show();
        }else{
            $('#contenedor-hitos-proyecto').hide();
        }
    },


    agregaHitoListado : function(hito){
        if($('#'+hito).val() === ""){
            BootModal.danger('Debe ingresar un nombre para agregar hito al listado');
        }else{
            Proyectos.num_hitos_agregados = $('.item_hito').length + 1;
            var item_hito = '<div class="row item_hito" id="item_hito_'+Proyectos.num_hitos_agregados+'">' +
                '<button type="button" class="btn btn-sm btn-flat btn-danger" onclick="Proyectos.sacarHitoListado('+Proyectos.num_hitos_agregados+');"><i class="fa fa-trash-o"></i></button>' +
                '<input type="hidden" name="listado_nombres_hitos[]" id="hito_nombre_'+Proyectos.num_hitos_agregados+'" value="'+$('#' + hito).val()+'" /> ' + $('#' + hito).val() + '' +
                '<input type="hidden" name="listado_hitos[]" id="hito_'+Proyectos.num_hitos_agregados+'" value="0" />' +
                '</div>';

            $("#contenedor-listado-hitos-proyecto").append(item_hito);
            $('#'+hito).val('')
            Proyectos.num_hitos_agregados++;
        }
    },

    sacarHitoListado : function(hito){
        $("#item_hito_" + hito).remove();
    },

    /**
     * Guardar formulario de Proyecto
     * @param form
     * @param btn
     */
    guardarProyecto : function(form, btn){
        Pangea.btnProcess(btn, 'Guardando');

        var error = '';

        if(form.nombre_proyecto.value === ""){
            error += '- Debe ingresar nombre del proyecto<br/>';
        }

        if(form.fecha_proyecto.value === ""){
            error += '- Debe seleccionar fecha de inicio del proyecto<br/>';
        }

        if(form.responsable_proyecto.value === ''){
            error += '- Debe seleccionar un responsable para el proyecto<br/>';
        }
        /*if(form.tiene_hitos_proyecto.checked){
            if($('.item_hito').length == 0){
                error += '- Debe ingresar hitos ya que se ha marcado <strong>Proyecto con hitos</strong><br/>';
            }
        }*/

        if(error !== ''){
            BootModal.danger(error, function(){
                Pangea.btnEndProcess();
            });
        }else{
            $.ajax({
                url : url_base + '/Proyectos/guardar',
                type : 'post',
                dataType : 'json',
                data : $(form).serializeArray(),
                success : function(response){
                    if(response.estado){
                        BootModal.success(response.mensaje, function(){
                            BootModal.closeAll();
                            Proyectos.listadoProyectos();
                        });
                    }else{
                        BootModal.danger(response.mensaje, function(){
                            Pangea.btnEndProcess();
                        });
                    }
                },
                error : function(){
                    BootModal.danger(Pangea.msg_error, function(){
                        Pangea.btnEndProcess();
                    });
                }
            })
        }
    },

    /**
     * cargar listado de proyectos
     */
    listadoProyectos : function () {
        $.ajax({
            url : url_base + '/Proyectos/listado',
            type : 'get',
            data : {},
            dataType : 'html',
            success : function (response) {
                $("#contenedor-listado-proyectos").html(response);
                Dtables.initTable('grilla-proyectos');
            },
            error : function () {
                BootModal.danger(Pangea.msg_error);
            }
        });
    },


    listadoMisProyectos : function () {
        $.ajax({
            url : url_base + '/ProyectosLider/listado',
            type : 'get',
            data : {},
            dataType : 'html',
            success : function (response) {
                $("#contenedor-mis-proyectos").html(response);
                Dtables.initTable('grilla-mis-proyectos');
            },
            error : function () {
                BootModal.danger(Pangea.msg_error);
            }
        })
    },


    rolesProyecto : function () {

    },
    
    
    guardarRolProyecto : function (form, btn) {
        Pangea.btnProcess(btn, 'Guardando');

        var error = "";
        if(form.nombre_rol.value === ""){
            error += 'Debe ingresar el nombre del Rol';
        }

        if(error !== ""){
            BootModal.danger(error, function () {
                Pangea.btnEndProcess();
            });
        }else{
            $.ajax({
                url : url_base + '/ProyectosLider/guardarRolProyecto',
                data : $(form).serializeArray(),
                type : 'post',
                dataType : 'json',
                success : function (response) {
                    if (response.estado) {
                        BootModal.success(response.mensaje, function () {
                            RolesProyecto.rolesProyecto(form.id_proyecto.value);
                            BootModal.closeAll();
                        });
                    } else {
                        BootModal.danger(response.mensaje, function () {
                            Pangea.btnEndProcess();
                        });
                    }
                },
                error : function () {
                    BootModal.danger( Pangea.msg_error, function () {
                        Pangea.btnEndProcess();
                    });
                }
            })
        }
    },


    cargarCalendarioProyecto: function (proyecto) {
        $("#calendario").fullCalendar({
            eventSources: [
                /* tareas prioridad 1 */
                {
                    url: url_base + '/TareasProyecto/listadoTareas',
                    type: 'post',
                    data: { prioridad: 1, proyecto: proyecto },
                    color: 'yellow',
                    textColor : 'black',
                    error: function () {
                        BootModal.danger("Error interno");
                    }
                },
                /* tareas prioridad 2 */
                {
                    url: url_base + '/TareasProyecto/listadoTareas',
                    type: 'post',
                    data: { prioridad: 2, proyecto: proyecto },
                    color: 'orange',
                    textColor: 'white',
                    error: function () {
                        BootModal.danger("Error interno");
                    }
                },
                /* tareas prioridad 3 */
                {
                    url: url_base + '/TareasProyecto/listadoTareas',
                    type: 'post',
                    data: { prioridad: 3, proyecto: proyecto },
                    color: 'red',
                    textColor: 'white',
                    error: function () {
                        BootModal.danger("Error interno");
                    }
                },
            ]
        });
    },


    listadoMuroProyecto: function (proyecto) {
        
    },


    cerrarProyecto : function (form, btn) {
        Pangea.btnProcess(btn, 'Cerrando');

        var error = "";

        if (form.comentario_cierre_proyecto.value == "") {
            error += 'Debe ingresar un comentario de cierre <br/>';
        }

        if (error !== "") {
            BootModal.danger(error, function() {
                Pangea.btnEndProcess();
            });
        } else {
            $.ajax({
                url : url_base + '/ProyectosLider/cerrarProyecto',
                data : $(form).serializeArray(),
                dataType : 'json',
                type : 'post',
                success : function (response) {
                    if (response.estado) {
                        BootModal.success(response.mensaje, function() {
                            window.location.href = url_base + '/ProyectosLider/misProyectos';
                        });
                    } else {
                        BootModal.danger(response.mensaje, function() {
                            Pangea.btnEndProcess();
                        });
                    }
                },
                error : function(){
                    BootModal.danger(Pangea.msg_error, function(){
                        Pangea.btnEndProcess();
                    });
                }
            });
        }

    },


    finalizar : function (proyecto) {
        BootModal.confirm('¿Desea finalizar este proyecto?', function() {
            $.ajax({
                url : url_base + '/Proyectos/finalizar',
                data : { proyecto: proyecto},
                dataType : 'json',
                type : 'post',
                success : function (response) {
                    if (response.estado) {
                        BootModal.success(response.mensaje, function () {
                            Proyectos.listadoProyectos();
                        });
                    } else {
                        BootModal.danger(response.mensaje);
                    }
                },
                error : function () {
                    BootModal.danger(Pangea.msg_error);
                }
            })
        });
    }

};