jQuery(document).ready(function($) {
	

$(function(){

	$(".editor").jqte(); 
	$("#datatable").DataTable();
	$(".datatable").DataTable();
	$('.datepicker').datepicker({
      format:'dd/mm/yyyy'
    });

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

// --> EFECTOS BOOTSTRAP

	// --> mensajes con popover pasando el id
	
 	$('[data-toggle="popover"]').hover(function () {
 		id=$(this).attr("id");

 		$("#" +id).hover('handlerIn', function (e) {
		  	$("#" +id).popover('hide');
		})
 		$("#" +id).popover('toggle');
 	})
	
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



 	
}); // --> Fin Función Anónima.


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

}); // --> Fin ReadyDocument