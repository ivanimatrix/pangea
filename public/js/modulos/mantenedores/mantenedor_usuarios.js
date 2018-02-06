
var MantenedorUsuarios = {

    /**
     * Filtrar listado de usuarios
     */
    filtrarUsuarios : function (form, btn) {
        Pangea.btnProcess(btn, 'Filtrando');
        $.ajax({
            url : url_base + '/MantenedorUsuarios/listado/' + form.filtro_perfil.value,
            data : {},
            type : 'get',
            dataType : 'html',
            success : function(response){
                $("#contenedor-grilla-usuarios").html(response);
                Dtables.initTable('grilla-usuarios');
                Pangea.btnEndProcess();
            }
        });
    },

    /**
     * Cargar listado de usuarios
     */
    cargarGrillaUsuarios : function(){
        $.ajax({
            url : url_base + '/MantenedorUsuarios/listado',
            data : {},
            type : 'get',
            dataType : 'html',
            success : function(response){
                $("#contenedor-grilla-usuarios").html(response);
                Dtables.initTable('grilla-usuarios');
            }
        });
    },

    /**
     * Guardar informacion de usuario
     * @param form
     * @param btn
     */
    guardarUsuario : function(form, btn){
        Pangea.btnProcess(btn, 'Guardando');
        
        var error = "";

        if(Validaciones.validaRut(form.rut.value) === false){
            error += 'RUT de usuario mal formado<br/>';
        }
        if(form.nombres.value === ""){
            error += 'Falta ingresar los nombres del usuario <br/>';
        }
        if(form.apellidos.value === ""){
            error += 'Falta ingresar apellidos del usuario <br/>';
        }
        if(Validaciones.validaEmail(form.email.value) === false){
            error += 'Debe ingresar un email válido';
        }
        if($('.perfiles:checked').length == 0){
            error += 'Debe seleccionar al menos un perfil para el usuario<br/>';
        }

        if(error !== ""){
            BootModal.danger(error, function () {
                Pangea.btnEndProcess();
            });
        }else{
            $.ajax({
                url : url_base + '/MantenedorUsuarios/guardar',
                data : $(form).serializeArray(),
                dataType : 'json',
                type : 'post',
                success : function(response){
                    if(response.estado){
                        BootModal.success(response.mensaje, function(){
                            MantenedorUsuarios.cargarGrillaUsuarios();
                            BootModal.closeAll();
                        });
                    }else{
                        BootModal.danger(response.mensaje, function(){
                            Pangea.btnEndProcess();
                        });
                    }
                },
                error :  function(){
                    BootModal.danger(Pangea.msg_error, function(){
                        Pangea.btnEndProcess();
                    });
                }
            });
        }
    },

    /**
     * Cargar perfil de un usuario
     * @param usuario
     */
    cargarPerfilUsuario : function(usuario){
        BootModal.confirm('¿Desea cargar el Perfil de este usuario?', function(){
            $.ajax({
                url : url_base + '/MantenedorUsuario/cargarUsuario',
                type : 'post',
                dataType : 'json',
                data : {usuario : usuario},
                success : function(response){
                    if(response.estado){
                        window.location.href = response.redirect;
                    }else{
                        BootModal.danger(response.mensaje);
                    }
                },
                error : function(){
                    BootModal.danger(Pangea.msg_error);
                }
            })
        });
    },

    /**
     * Cerrar sesion de usuario cargado
     */
    cerrarPerfilUsuario : function(){
        BootModal.confirm('¿Desea volver a su Perfil?', function(){
            $.ajax({
                url : url_base + '/MantenedorUsuario/cerrarPerfilUsuario',
                type : 'post',
                dataType : 'json',
                data : {},
                success : function(response){
                    if(response.estado){
                        window.location.href = response.redirect;
                    }else{
                        BootModal.danger(response.mensaje);
                    }
                },
                error : function(){
                    BootModal.danger(Pangea.msg_error);
                }
            })
        });
    }
}