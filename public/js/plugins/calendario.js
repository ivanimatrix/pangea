document.write('<link href="'+url_base+'/public/template/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet" />');
document.write('<script src="'+url_base+'/public/template/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js" type="text/javascript"></script>');
document.write('<script src="'+url_base+'/public/template/bower_components/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js" type="text/javascript"></script>');

document.write('<link href="'+url_base+'/public/template/bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet" />');
document.write('<link href="'+url_base+'/public/template/bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print" />');
document.write('<script src="'+url_base+'/public/template/bower_components/moment/moment.js" type="text/javascript"></script>');
document.write('<script src="'+url_base+'/public/template/bower_components/fullcalendar/dist/fullcalendar.min.js" type="text/javascript"></script>');
document.write('<script src="'+url_base+'/public/template/bower_components/fullcalendar/dist/locale/es.js" type="text/javascript"></script>');


var Calendario = {

	init : function(){
		$(document).ready(function(){
            $('.datepicker').each(function(){

                var startDate = '';
                if($(this).data('start-date') !== undefined){
                    startDate = $(this).data('start-date');
                }

                $(this).datepicker({
                    format: 'dd/mm/yyyy',
                    language: 'es',
                    autoclose: true,
                    startDate : startDate
                }).on('changeDate', function(ev) {
                    //
                }).on('hide', function(event) {
                    event.preventDefault();
                    event.stopPropagation();
                });
            });

			
			



			/*$('.datetimepicker').datetimepicker({
				format: 'dd/mm/yyyy hh:ii',
				language: 'es',
				autoclose: true,
				weekStart : 1
			});*/
		});
	},


	showCalendar : function (calendario, eventos) {
		$("#" + calendario).fullCalendar({
			events : eventos
		});
	}
	/*datePicker : function(){
		$( ".datepicker" ).datepicker({
			autoSize: true,
			dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
			dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
			firstDay: 1,
			monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
			monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
			dateFormat: 'dd/mm/yy',
			changeMonth: true,
			changeYear: true,
			yearRange: "-90:+1"
		});
	}
}

$(document).ready(function(){
	$( ".datepicker" ).datepicker({
		autoSize: true,
		dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
		dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
		firstDay: 1,
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
		dateFormat: 'dd/mm/yy',
		changeMonth: true,
		changeYear: true,
		yearRange: "-90:+1"
	});

	$(".datetimepicker").datetimepicker({
		controlType: "select",
		timeFormat: "HH:mm",
		dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
		dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
		firstDay: 1,
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
		dateFormat: 'dd/mm/yy',
		changeMonth: true,
		changeYear: true,
		yearRange: "-90:+1",
		timeText: 'Tiempo',
		hourText: 'Horas',
		minuteText: 'Minutos',
		secondText: 'Segundos',
		millisecText: 'Milisegundos',
		microsecText: 'Microsegundos',
		timezoneText: 'Time Zone',
		currentText: 'Ahora',
		closeText: 'Hecho'
	});*/
};


Calendario.init();