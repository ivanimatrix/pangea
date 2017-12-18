

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
    }

}