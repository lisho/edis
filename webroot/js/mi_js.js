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
					success: function(tecnico) {
		
						$.each(tecnico,function(key, value) {   
							//$("#tecnico_ceas").append($("<option></option>").attr("value", key).text(value));
							$('<option>').val(key).text(value).appendTo($("#tecnico_ceas"));
						});
					} 				
				});	

				
/*
				if ($.inArray(nombre_elegido, edis1)) {
					var equipo = "EDIS1";
				}

				if ($.inArray(nombre_elegido, edis2)) {
					var equipo = "EDIS2";	
				}
*/
				$.ajax({
					type: "POST",
					url: "/edis/equipos/combotedis",
					
					data: "edis="+elegido,
					cache: false,
					success: function(tecnico) {
		
						$.each(tecnico,function(key, value) {   
							//$("#tecnico_ceas").append($("<option></option>").attr("value", key).text(value));
							$('<option>').val(key).text(value).appendTo($("#tecnico_inclusion"));
						});
					} 				
				});			
			};
		});









/*



	$('#ceas').change(function() {

		$('#ceas option:selected').each(function() {
			elegido=$(this).val();
			ajaxupdate($(this). data);
			$('#tecnico_ceas').html(data);
		});
	});


	function ajaxupdate(elegido) {
		$.ajax({
			type: "POST",
			url: "/edis/equipos/combots",
			data:{
				
				elegido: elegido
			},

			dataType: "json",

		});
	}
*/

// --> Fin Combo CEAS

});

});