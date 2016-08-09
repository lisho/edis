jQuery(document).ready(function($) {
	

$(function(){

	$("textarea").jqte(); 
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
 		
 		$("#" +id).popover('toggle');
 		})

 	$('#add_tecnico').click(function () {
 		$(this).modal();
 		})
}); // --> Fin Función Anónima.

}); // --> Fin ReadyDocument