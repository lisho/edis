jQuery(document).ready(function($) {

	var url_json = "/edis/"; //raiz de url
	
	$(".editor").jqte(); 
	
	$.fn.dataTable.moment( 'DD/MM/YYYY' );
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

	$(".datatable_nobtn").DataTable();

	// --> EFECTOS BOOTSTRAP
	
	$('.datepicker').datepicker({
	        format:'dd/mm/yyyy',
	        
    })

	// --> mensajes con popover pasando el id
	
 	$('[data-toggle="popover"]').hover(function () {
 		id=$(this).attr("id");

 		$("#" +id).hover('handlerIn', function (e) {
		  	$("#" +id).popover('hide');
		})
 		$("#" +id).popover('toggle');
 	});

 	$('#cerrar_ventana').click(function() {
		var expediente = $(this).data("expediente");
		cerrar_ventana(expediente);
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
					url: url_json+"equipos/combots",
					data: "ceas="+elegido,
					cache: false,
					success: function(tecnico_ceas) {
						
						$('<option>').text('Selecciona un Coordinador de Caso').appendTo($("#tecnico_ceas"));
						$.each(tecnico_ceas,function(key, value) {   
							//$("#tecnico_ceas").append($("<option></option>").attr("value", key).text(value));
							$('<option>').val(key).text(value).appendTo($("#tecnico_ceas"));
						});

						//$("#tecnico_ceas > option:nth-child(1)").attr('selected', 'selected');
					} 

				});	

				$.ajax({
					type: "POST",
					url: url_json+"equipos/combotedis",
					
					data: "ceas="+elegido,
					cache: false,
					success: function(tecnico_edis) {
		
						$('<option>').text('Selecciona un Técnico de Inclusión').css('color', 'red').appendTo($("#tecnico_inclusion"));
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
 	// --> Despliegue de modales		
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
	                url:url_json+"participantes/searchjson",
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
	        
	        //.addClass('fa fa-arrow-circle-right')
	        .data("item.autocomplete", item)
	        .append("<i class='fa fa-arrow-circle-right'><a href='"+url_json+"expedientes/view/"+item.exp_id+"'><b> Exp: "+" "+item.exp +" </b>-- "+ item.nombre +" "+ item.apellidos + " (" + item.dni + ")</a></i>")
	        .appendTo(ul)
	    }; // --> Fin Buscador
	} // END if


	// --> ************** BUSCADOR DE EXPEDIENTES PARA COMISION **************************

	if ($('#busca_para_comision').length > 0 ) {
		$('#busca_para_comision').autocomplete ({
			minLength: 2,
			select:function(event, ui){
				expediente_id = ui.item.exp_id;
				//console.log(ui.item);
				numedis = ui.item.exp;
				numhs = ui.item.hs;
				nombre_completo = ui.item.nombre+' '+ui.item.apellidos;
				//$('#datos_expediente').html(ui.item);
				$('#busca_para_comision').val(ui.item.label).attr('data', expediente_id);
				$('#campo_expediente').val(expediente_id);
				$('#modal_add_pasacomision').modal();
		 		$('#datos_expediente').html('<p>Has buscado a : <b>'+nombre_completo+' ('+ui.item.dni+')</b></p>'+
		 									'<p>Expediente EDIS: <b>'+numedis+'</b></p>'+
		 									'<p>Historia Social: <b>'+numhs+'</b></p>'
		 					);
			},

			source:function(request, response){
				$.ajax({
					url:url_json+"participantes/searchjson",
					data:{
						term:request.term
					},
					dataType: "json",
					success: function(data){
						response($.map(data,function(el,index){
							return{
								value:el.expediente.numedis,
								//pasadato:el.expediente.id,
	                            nombre:el.nombre,
	                            apellidos:el.apellidos,
	                            dni: el.dni,
	                            id: el.id,
	                            exp: el.expediente.numedis,
	                            hs: el.expediente.numhs,
	                            exp_id: el.expediente.id
							};						
						}));
					}
				});
			}

		}).data("ui-autocomplete")._renderItem = function(ul, item){
			return $("<li style='display:block'></li>")
			.addClass('fa fa-plus')
			.data("item.autocomplete", item)
			.append("<a href='#' class='caza_expediente' id='"+item.exp_id+"'>"+"<b>("+item.exp+") "+item.dni +" - "+ item.nombre +" "+ item.apellidos + "</a>")
			.appendTo(ul);

		}; 
	} 
	/*
	$('#add_pasacomision').click(function () {

		var expediente = $('#busca_para_comision').val();
		$('#campo_expediente').val(expediente);
	 	$('#modal_add_pasacomision').modal();
	 	$('#datos_expediente').html('Expediente EDIS:'+expediente);

	});
	*/

	// --> ************** BUSCADOR DEL MENU *************************************************************************

	$('#s').autocomplete ({
		minLength: 2,
		select:function(event, ui){
			$('#s').val(ui.item.label);
		},

		source:function(request, response){
			$.ajax({
				url:url_json+"participantes/searchjson",
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
		return $("<li style='display:block'></li>")
		.addClass('fa fa-arrow-circle-right')
		.data("item.autocomplete", item)
		.append("<a href='"+url_json+"participantes/view/"+item.id+"'>"+" "+item.dni +" - "+ item.nombre +" "+ item.apellidos + "</a>")
		.appendTo(ul)
	}; // --> Fin Buscador




// --> *********** VALIDACIONES PARA NUEVO EXPEDIENTE ***************//

	// numedis
	var numedis = $('#numedis').val();
	var id = 'numedis';
	actualizar_datos(numedis,id); 
	$("#numedis").change(function() {
			var numedis = $(this).val();
			var id = 'numedis'; 
			actualizar_datos(numedis,id);  
		});

	// numhs
	var numhs = $('#numhs').val();
	var id = 'numhs';
	actualizar_datos(numhs,id); 
	$("#numhs").change(function() {
			var numhs = $(this).val(); 
			var id = 'numhs';
			actualizar_datos(numhs,id);  
		});

	//domicilio
	var domicilio = $('#domicilio').val();
	var id = 'domicilio';
	actualizar_datos(domicilio,id); 
	$("#domicilio").change(function() {
			var domicilio = $(this).val(); 
			var id = 'domicilio';
			actualizar_datos(domicilio,id);  
		});

	// ceas
	var ceas = $('#ceas option:selected').text();
	var id = 'ceas';
	actualizar_datos(ceas,id); 
	$("#ceas").change(function() {
			var ceas = $('#ceas option:selected').text(); 			
			if (ceas==='Elije un Ceas') {var ceas = '';}
			var id = 'ceas';
			actualizar_datos(ceas,id);

		});

	// cc
	var tecnico_ceas = $('#tecnico_ceas option:selected').text();
	var id = 'tecnico_ceas';
	actualizar_datos(tecnico_ceas,id); 
	$("#tecnico_ceas").change(function() {
			var tecnico_ceas = $('#tecnico_ceas option:selected').text(); 
			if (tecnico_ceas==='Elije un Coordinador de Caso') {var tecnico_ceas = '';}
			var id = 'tecnico_ceas';
			actualizar_datos(tecnico_ceas,id);  
		});

	// tedis
	var tecnico_inclusion = $('#tecnico_inclusion option:selected').text();
	var id = 'tecnico_inclusion';
	actualizar_datos(tecnico_inclusion,id); 
	$("#tecnico_inclusion").change(function() {
		var tecnico_inclusion = $('#tecnico_inclusion option:selected').text(); 
		if (tecnico_inclusion==='Elije un Técnico de Inclusión') {var tecnico_inclusion = '';}
		var id = 'tecnico_inclusion';
		actualizar_datos(tecnico_inclusion,id);  
	});

	// dni
	var dni = $('#participantes-0-dni').val();
	var id = 'participantes-0-dni';
	actualizar_datos(dni,id); 
	$("#participantes-0-dni").change(function() {
			var dni = $(this).val(); 
			var id = 'participantes-0-dni';
			actualizar_datos(dni,id);  
		});

	//nombre
	var nombre = $('#participantes-0-nombre').val();
	var id = 'participantes-0-nombre';
	actualizar_datos(nombre,id); 
	$("#participantes-0-nombre").change(function() {
			var nombre = $(this).val(); 
			var id = 'participantes-0-nombre';
			actualizar_datos(nombre,id);  
		});

	// apellidos
	var apellidos = $('#participantes-0-apellidos').val();
	var id = 'participantes-0-apellidos';
	actualizar_datos(apellidos,id); 
	$("#participantes-0-apellidos").change(function() {
			var apellidos = $(this).val(); 
			var id = 'participantes-0-apellidos';
			actualizar_datos(apellidos,id);  
		});


	// sexo
	var sexo = $('#nuevo_expediente input:radio:checked').val();
	var id = 'sexo';
	if (sexo==='F') {var sexo='Mujer';}
	else if (sexo==='M') {var sexo='Hombre';}
	else {var sexo='';}
	actualizar_datos(sexo,id); 
	$( "#nuevo_expediente input:radio" ).click(function() {
		var sexo = $(this).val(); 
		if (sexo==='F') {var sexo='Mujer';}
		else if (sexo==='M') {var sexo='Hombre';}
		else {var sexo='';}
		var id = 'sexo';
		actualizar_datos(sexo,id);  
		});

	// nacimiento

	var nacimiento = $('#participantes-0-nacimiento').text();
	var id = 'participantes-0-nacimiento';
	actualizar_opcional(nacimiento,id); 
	$("#participantes-0-nacimiento").datepicker()
  	.on('changeDate', function(ev){
	    var nacimiento = $("#participantes-0-nacimiento").val(); 
	    var id = 'participantes-0-nacimiento';
		actualizar_opcional(nacimiento,id);  
    });
    $("#participantes-0-nacimiento").change(function() {
	    var nacimiento = $("#participantes-0-nacimiento").val(); 
	    var id = 'participantes-0-nacimiento';
		actualizar_opcional(nacimiento,id);  
    });

	// email
	var email = $('#participantes-0-email').val();
	var id = 'participantes-0-email';
	actualizar_opcional(email,id); 
	$("#eparticipantes-0-mail").change(function() {
			var email = $(this).val(); 
			var id = 'participantes-0-email';
			actualizar_datos(email,id);  
		});

	//telefono
	var telefono = $('#participantes-0-telefono').val();
	var id = 'participantes-0-telefono';
	actualizar_opcional(telefono,id); 
	$("#participantes-0-telefono").change(function() {
			var telefono = $(this).val(); 
			var id = 'participantes-0-telefono';
			actualizar_datos(telefono,id);  
		});

	// Observaciones del Titular
	var observaciones_titular = $('#participantes-0-observaciones').text();
	var id = 'participantes-0-observaciones';
	actualizar_opcional(observaciones_titular,id); 
	$("#participantes-0-observaciones").change(function() {
			var observaciones_titular = $(this).val(); 
			var id = 'participantes-0-observaciones';
			actualizar_datos(observaciones_titular,id);  
		});



	function actualizar_datos(dato,id) {

		if (dato==='') { 
				var dato = 'No has introducido información';
				$("#li-"+id).html("<b>"+dato+"</b>").addClass('error');
			}else{$("#li-"+id).html("<b>"+dato+"</b>").removeClass('error');}
	}

	function actualizar_opcional(dato,id) {

		if (dato==='') { 
				var dato = 'No has introducido información';
				$("#li-"+id).html("<b>"+dato+"</b>").addClass('alert-warning');
			}else{$("#li-"+id).html("<b>"+dato+"</b>").removeClass('alert-warning');}
	}

	
	
			//$("#li-sexo").addClass('error');
			

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


	function cerrar_ventana(expediente){
		
		if(confirm('¿Seguro que deseas cerrar el expediente '+expediente+'?')){
		close();
		}
	}
			

// --> *********** CHECKBOX ASISTENTES A COMISION ***************//

	$('input.tecnico_check').change(function(){ 
		var tecnico_id = $(this).val();
		//var comision_id = <?php echo $comision['id'] ?>;
		var datos = {"tecnico_id":tecnico_id, "comision_id":comision_id};
		if (tecnico_id) {
				$.ajax({
					type: "POST",
					url: url_json+"asistentecomisions/add",
					data: datos,
					//dataType: "json",
					cache: false,
					});
				};			
	});

	$('#recargar_pagina').click(function() {
		location.reload();
	});

//--> Cambio de Secretario de comision

	$('#secretaria').change(function() {

		var secretario=$(this).val();
		var datos_nuevo_secretario = {"id":secretario, "comision_id":comision_id, "rol":"secretario"};

		

		if (secretario) {

			if (typeof antiguo_secretario != 'undefined') {
			var datos_viejo_secretario = {"id":antiguo_secretario, "comision_id":comision_id, "rol":"asistente"};

				$.ajax({
					type: "POST",
					url: url_json+"asistentecomisions/edit/"+antiguo_secretario,
					data: datos_viejo_secretario,
					cache: false,
				});	
			}

				$.ajax({
					type: "POST",
					url: url_json+"asistentecomisions/edit/"+secretario,
					data: datos_nuevo_secretario,
					cache: false,
					success: function() {
						location.reload();
					}
				});	
			}
	});

//--> FIN Cambio de Secretario de comision

	function confirmar(texto) {
		return confirm (texto);
	}

}); // --> Fin ReadyDocument



