jQuery(document).ready(function($) {

	
	$(".editor").jqte(); 

	$("#datatable").DataTable({
			dom: 'Blfrtip',
		    buttons: [ 'copy', 
		    			'csv', 
		    			//'excel',
		    			//'pdf',
		    			'print' ]
		});

	$(".datatable").DataTable({
    dom: 'Blfrtip',
    buttons: [ 'copy', 
    			'csv', 
    			//'excel',
    			//'pdf',
    			'print' ]
	});

	// --> EFECTOS BOOTSTRAP
	
	$('.datepicker').datepicker({
      format:'dd/mm/yyyy'
    });

	// --> mensajes con popover pasando el id
	
 	$('[data-toggle="popover"]').hover(function () {
 		id=$(this).attr("id");

 		$("#" +id).hover('handlerIn', function (e) {
		  	$("#" +id).popover('hide');
		})
 		$("#" +id).popover('toggle');
 	});

$(function(){

	

// --> Inicio Combo CEAS


	$('#ceas').change(function() {
		
			elegido=$(this).val();
		/*	
			edis1 = [	'CEAS ARMUNIA',
						'CEAS PARQUE DE LOS REYES',
						'CEAS EJIDO',
						'CEAS PALOMERA'];

			edis2 = [	'CEAS CRUCERO',
						'CEAS CENTRO',
						'CEAS MARIANO ANDRES (Frontón)',
						'CEAS MARIANO ANDRES (Ventas Este)'];
*/

			$("#tecnico_ceas").find('option').remove();
			$("#tecnico_inclusion").find('option').remove();
			if (elegido) {
				$.ajax({
					type: "POST",
					url: "/edis/equipos/combots",
					data: "ceas="+elegido,
					cache: false,
					success: function(tecnico_ceas) {
		
						$.each(tecnico_ceas,function(key, value) {   
							//$("#tecnico_ceas").append($("<option></option>").attr("value", key).text(value));
							$('<option>').val(key).text(value).appendTo($("#tecnico_ceas"));
						});
					} 

				});	

				$.ajax({
					type: "POST",
					url: "/edis/equipos/combotedis",
					
					data: "ceas="+elegido,
					cache: false,
					success: function(tecnico_edis) {
		
						//tecnico_edis=$.parseJSON(tecnico_edis);
						$.each(tecnico_edis,function(key, value) {   
							//$("#tecnico_ceas").append($("<option></option>").attr("value", key).text(value));
							$('<option>').val(key).text(value).appendTo($("#tecnico_inclusion"));
						});
					} 				
				});	
			};
		});

// --> Fin Combo CEAS - EDIS



 	
}); // --> Fin Función Anónima.



	
 	// ******************************************** 
 	// --> Desplegue de modales		
 	// *** necesaria clase en el botón: .modal-btn
 	// *** necesario id en el boton
 	// *** id del modal = #modal_ + id_del_boton
 	// ******************************************** 

	$('.modal-btn').click(function () {
		
		id=$(this).attr("id");
	 	$('#modal_'+id).modal();

	 });


	// --> ************** BUSCADOR DE PARTICIPANTES PARA NUEVO EXPEDIENTE **************************

	if ( $("#busca").length > 0 ) {   
	    $('#busca').autocomplete ({
	        minLength: 2,
	        select:function(event, ui){
	            $('#busca').val(ui.item.label);
	        },

	        source:function(request, response){
	            $.ajax({
	                url:"/edis/participantes/searchjson",
	                data:{
	                    term:request.term
	                },
	                dataType: "json",
	                success: function(data){
	                    response($.map(data,function(el,index){
	                        return{
	                            value:el.nombre,
	                            nombre:el.nombre,
	                            apellidos:el.apellidos,
	                            dni: el.dni,
	                            id: el.id,
	                            exp: el.expediente.numedis,
	                            exp_id: el.expediente.id
	                        };
	                    }));
	                }
	            });
	        }

	    }).data("ui-autocomplete")._renderItem = function(ul, item){
	        
	    return $("<li></li>")
	        
	        .addClass('fa fa-arrow-circle-right')
	        .data("item.autocomplete", item)
	        .append("<a href='/edis/expedientes/view/"+item.exp_id+"'><b> Exp: "+" "+item.exp +" </b>-- "+ item.nombre +" "+ item.apellidos + " (" + item.dni + ")</a>")
	        .appendTo(ul)
	    }; // --> Fin Buscador
	} // END if



	// --> ************** BUSCADOR DEL MENU *************************************************************************

	$('#s').autocomplete ({
		minLength: 2,
		select:function(event, ui){
			$('#s').val(ui.item.label);
		},

		source:function(request, response){
			$.ajax({
				url:"/edis/participantes/searchjson",
				data:{
					term:request.term
				},
				dataType: "json",
				success: function(data){
					response($.map(data,function(el,index){
						return{
							value:el.nombre,
							nombre:el.nombre,
							apellidos:el.apellidos,
							dni: el.dni,
							id: el.id
						};
					}));
				}
			});
		}

	}).data("ui-autocomplete")._renderItem = function(ul, item){
		return $("<li></li>")
		.addClass('fa fa-arrow-circle-right')
		.data("item.autocomplete", item)
		.append("<a href='/edis/participantes/view/"+item.id+"'>"+" "+item.dni +" - "+ item.nombre +" "+ item.apellidos + "</a>")
		.appendTo(ul)
	}; // --> Fin Buscador








// --> *********** VALIDACIONES PARA NUEVO EXPEDIENTE ***************//


	$("#numedis").change(function() {
			var numedis = $(this).val(); 
			$("#li-numedis").html(numedis).addClass('');
		});

	$("#numhs").change(function() {
			var numhs = $(this).val(); 
			$("#li-numhs").html(numhs).addClass('');
		});

	var sexo = $('form input:radio').val(); 
			//$("#li-sexo").addClass('error');
			$("#li-sexo").val(sexo).addClass('');

/*
	$("#sexo").change(function() {
			var sexo = $(this).val(); 
			$(this).addClass('error')
			$("#li-sexo").val(sexo).html().addClass('');
		});
*/
/*
	$("#nuevo_expediente :input" ).change(function() {
			this.each(function(){
				var id = $(this).val('id', function(){
					var $(id) = $(this).val();
					$("<li></li>").html(' Número de Expediente: '+numedis).addClass('fa fa-arrow-circle-right').appendTo($('#datos_expediente'));
				});
			}
		});
*/
/*
	$(function() {
		
		$('#crea_expediente').click(function() {
			var numedis = $("#li-numedis").text();
			var numhs = $("#li-numhs").text();
			
			if (numedis==='Sin datos.'||numedis==='') {				
				$("#div-numedis").addClass('error');
				return false; // Don't submit form for this demo
			} else { $("#div-numedis").removeClass('error');}

			if (numhs==='Sin datos.'||numhs==='') {				
				$("#div-numhs").addClass('error');
				return false; // Don't submit form for this demo
			} else { $("#div-numhs").removeClass('error');}
		    

		  });

		
	}) /* FIN función anónima.*/



			




}); // --> Fin ReadyDocument




