
/**
 * módulo Login
 */
var Login = {

    /**
     * Validar login de usuario
     * @param form Formulario a validar
     * @param btn Boton que ejecuta funcion
     */
    validar : function(form, btn){
        Pangea.btnProcess(btn, 'Validando');

        var error = "";
        if(form.rut.value == ""){
            error += 'Debe ingresar su rut válido <br/>';
        }
        if(form.pass.value == ""){
            error += 'Debe ingresar su contraseña<br/>';
        }

        if(error !== ""){
            BootModal.danger(error, function(){
                Pangea.btnEndProcess();
            });
        }else{
            $.ajax({
                url : url_base + '/Login/validarLogin',
                data : $(form).serializeArray(),
                dataType : 'json',
                type : 'post',
                success : function(response){
                    if(response.estado){
                        window.location.href = response.redirect;
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
     * Solicitar nueva contraseña
     * @param form Formulario
     * @param btn Boton que ejecuta la funcion
     */
    solicitarPassword : function(form, btn){
        Pangea.btnProcess(btn, 'Solicitando');

        var error = "";
        if(form.email.value == ""){
            BootModal.danger('Debe ingresar un correo válido', function(){
                Pangea.btnEndProcess();
            });
        }else{
            $.ajax({
                url : url_base + '/Usuario/generarPassword',
                data : $(form).serializeArray(),
                type : 'post',
                dataType : 'json',
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
            })
        }
    }

}