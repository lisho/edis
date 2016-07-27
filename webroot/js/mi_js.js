
$(function(){

	$("textarea").jqte(); 
	$("#datatable").DataTable();
	$(".datatable").DataTable();
	$('.datepicker').datepicker({
      format:'dd/mm/yyyy'
    });

// --> Inicio Combo CEAS

	$('#ceas').change(function() {
		$('#ceas option:selected').each(function() {
			elegido=$(this).val();
			$.post('combo.php', {elegido: elegido}, function(data) {
				$('#trabajador_social').html(data);
			});
		});
	});
	
// --> Fin Combo CEAS

});
