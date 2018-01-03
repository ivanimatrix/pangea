

var Usuario = {


    actualizarPassword : function(form, btn){
        Pangea.btnProcess(btn, 'Actualizando');

        var error = "";
        if(form.nueva_pass.value == ""){
            error += 'Su nueva contraseña no puede ser vacía <br/>';
        }
        if(form.nueva_pass.value !== form.repetir_pass.value){
            error += 'Las contraseñas no coinciden<br/>';
        }

        if(error !== ''){
            BootModal.danger(error, function(){
                Pangea.btnEndProcess();
            });
        }else{
            $.ajax({
                url : url_base + '/Usuario/actualizarPassword',
                type : 'post',
                dataType : 'json',
                data : $(form).serializeArray(),
                success : function(response){
                    if(response.estado){
                        BootModal.success(response.mensaje, function(){
                            BootModal.closeAll();
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
            });
        }
    },

    /**
     * Guardar datos de usuario actualizados
     * @param form
     * @param btn
     */
    actualizarMisDatos :  function(form, btn){
        Pangea.btnProcess(btn, 'Guardando');

        var error = "";
        if(form.rut.value === ""){
            error += '- Debe ingresar su rut<br/>';
        }
        if(form.nombres.value === ""){
            error += '- Debe ingresar sus nombres<br/>';
        }
        if(form.apellidos.value === ""){
            error += '- Debe ingresar sus apellidos <br/>';
        }
        if(form.email.value === ""){
            error += '- Debe ingresar su correo electrónico<br/>';
        }

        if(error !== ""){
            BootModal.danger(error, function(){
                Pangea.btnEndProcess();
            });
        }else{
            $.ajax({
                url : url_base + '/Usuario/actualizarDatos',
                type : 'post',
                dataType : 'json',
                data : $(form).serializeArray(),
                success : function(response){
                    if(response.estado){
                        BootModal.success(response.mensaje, function(){
                            window.location.reload();
                        });
                    }else{
                        BootModal.danger(response.mensaje, function(){
                            Pangea.btnEndProcess();
                        });
                    }
                },
                error : function (){
                    BootModal.danger(Pangea.msg_error, function () {
                        Pangea.btnEndProcess();
                    })
                }
            })
        }
    },


    cambiarAvatar : function (form, btn) {
        Pangea.btnProcess(btn, 'Actualizando');
        var error = "";

        if(form.avatar.value === ""){
            BootModal.danger('No ha seleccionado archivo <br/>', function () {
                Pangea.btnEndProcess();
            });
        }else{
            var form_data = new FormData(document.getElementById(form.id));
            $.ajax({
                url : url_base + '/Usuario/cambiarAvatar',
                processData : false,
                contentType : false,
                async : false,
                data : form_data,
                type : 'post',
                dataType : 'json',
                success : function (response) {
                    if(response.estado){
                        BootModal.success(response.mensaje, function () {
                            $("#img-avatar-usuario").attr('src', response.avatar);
                            BootModal.closeAll();
                        });
                    }else{
                        BootModal.danger(response.mensaje, function () {
                            Pangea.btnEndProcess();
                        });
                    }
                },
                error :  function (xhr, ajaxOptions, thrownError) {
                    var error_msg = "";
                    var responseJson = xhr.responseJSON.errors.avatar;
                    for ( var i = 0; i < responseJson.length; i++){
                        error_msg += responseJson[i] + '<br/>';
                    }
                    BootModal.danger(error_msg, function () {
                        Pangea.btnEndProcess();
                    });
                }
            });
        }

    },


    cargarPerfil : function (form, btn) {
        Pangea.btnProcess(btn, 'Cargando');
        
        if($('.cargar-perfil:checked').length == 0){
            BootModal.danger("Debe seleccionar un perfil para ser cargado", function () {
                Pangea.btnEndProcess();
            });
        } else {
            $.ajax({
                url : url_base + '/Usuario/cargarPerfilActivo',
                data : $(form).serializeArray(),
                type : 'post',
                dataType : 'json',
                success :  function (response) {
                    if(response.estado){
                        window.location.href = response.redirect;
                    }else{
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