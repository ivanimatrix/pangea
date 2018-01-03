
var RolesProyecto = {

    /**
     * Obtener roles de un proyecto
     * @param proyecto
     */
    rolesProyecto : function (proyecto) {
        $.ajax({
            url : url_base + '/RolesProyecto/listado/' + proyecto,
            data : {},
            dataType : 'json',
            type : 'get',
            success : function (response) {
                var roles = '';
                if(response.roles.length > 0){
                    for (var i = 0; i < response.roles.length; i++) {
                        var rol = response.roles[i];
                        roles += '<li class="list-group-item">' +
                            '<b>'+rol.nombre+'</b> ' +
                            '<a class="pull-right btn-xs" href="javascript:void(0);" onclick="RolesProyecto.eliminarRolProyecto('+rol.proyecto+','+rol.id+');"><i class="fa fa-trash-o"></i></a>' +
                            '<a class="pull-right btn-xs" href="javascript:void(0);" onclick="RolesProyecto.editarRolProyecto('+rol.proyecto+','+rol.id+');"><i class="fa fa-edit"></i></a>' +
                            '<span class="help-block">'+rol.descripcion+'</span>' +
                            '</li>';
                    }
                }
                $('#contenedor-listado-roles').html(roles);
            }
        })
    },

    editarRolProyecto : function (proyecto, rol) {
        BootModal.open(url_base + '/ProyectosLider/editarRol/' + proyecto + '/' + rol,'Editar Rol Proyecto');
    },

    eliminarRolProyecto : function (proyecto, rol) {
        BootModal.confirm('¿ Desea eliminar este rol del Proyecto ?', function () {
            $.ajax({
                url : url_base + '/RolesProyecto/eliminarRol',
                type : 'post',
                data : {rol : rol},
                dataType : 'json',
                success : function (response) {
                    if(response.estado){
                        BootModal.success(response.mensaje, function () {
                            RolesProyecto.rolesProyecto(proyecto);
                        });
                    }else{
                        BootModal.danger(response.mensaje);
                    }
                },
                error : function () {
                    BootModal.danger(Pangea.msg_error);
                }
            });
        });
    }

};