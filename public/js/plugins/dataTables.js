document.write('<link href="' + url_base+ '/public/template/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css?' + Math.random() + '" type="text/css" rel="stylesheet"/>');
//document.write('<link href="' + url_base +'/public/plugins/dataTables.bootstrap.min.css?' + Math.random() + '" rel="stylesheet" type="text/css" />');
//document.write('<link href="' + url_base+ '/public/template/bower_components/datatables.net/js/buttons.dataTables.min.css?' + Math.random() + '" type="text/css" rel="stylesheet"/>');

document.write('<script src="'+ url_base + '/public/template/bower_components/datatables.net/js/jquery.dataTables.min.js?' + Math.random() + '" type="text/javascript"></script>');
document.write('<script src="'+ url_base + '/public/template/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js?' + Math.random() + '" type="text/javascript"></script>');

document.write('<script src="' + url_base + '/public/template/bower_components/datatables.net/js/dataTables.buttons.min.js?' + Math.random() + '" type="text/javascript"></script>');
document.write('<script src="' + url_base + '/public/template/bower_components/datatables.net/js/buttons.html5.min.js?' + Math.random() + '" type="text/javascript"></script>');
document.write('<script src="' + url_base + '/public/template/bower_components/datatables.net/js/jszip.min.js?' + Math.random() + '" type="text/javascript"></script>');
document.write('<script src="' + url_base + '/public/template/bower_components/datatables.net/js/pdfmake.min.js?' + Math.random() + '" type="text/javascript"></script>');
document.write('<script src="' + url_base + '/public/template/bower_components/datatables.net/js/vfs_fonts.js?' + Math.random() + '" type="text/javascript"></script>');
document.write('<script src="' + url_base + '/public/template/bower_components/datatables.net/js/buttons.print.min.js?' + Math.random() + '" type="text/javascript"></script>');


var Dtables = {

    initTable : function(tabla, options){

        if($("#"+tabla).data('rows')) {
            var filas = parseInt($("#"+tabla).data('rows'));
        } else {
            var filas = 10;
        }

        var filename = 'listado.xlsx';
        if($("#"+tabla).data('name')){
            filename = $("#"+tabla).data('name');
        }

        var buttons = [];
        if($("#"+tabla).data("export")){
            buttons = [
                {
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-file-excel-o"></i> Exportar a Excel',
                    className : 'btn btn-sm bg-olive btn-flat',
                    filename : filename
                }
            ];
        }

        var dataOptions = {
            "lengthMenu": [[5,10, 20, 25, 50, 100], [5, 10, 20, 25, 50, 100]],
            "pageLength": filas,
            "destroy" : true,
            "aaSorting": [],
            "deferRender": true,
            responsive: true,
            "dom": '<"top"fl>Brt<"bottom"ip><"clear">',
            buttons: buttons,
            language:
                {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }

        };


        if(options !== undefined && (typeof options === 'object')){
            dataOptions.push(options);
        }

        var table = $("#" + tabla).DataTable(dataOptions);

    }

};
