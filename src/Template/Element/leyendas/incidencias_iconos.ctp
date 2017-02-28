<?php 

	switch ($tipo) {
		case 1:
			// entrevista con cita
			$ico = 'fa fa-calendar';
			$msj = "Entrevista con cita";
			break;
		
		case 2:
			// sin cita
			$ico = 'fa fa-calendar-o';
			$msj = "Entrevista sin cita";
			break;

		case 4:
		case 5:
			// Inicio/fin trabajos
			$ico = 'fa fa-linkedin-square';
			$msj = "Actividad laboral";
			break;

		case 6:
			// otras
			$ico = 'fa fa-cubes';
			$msj = "Otras actuaciones";
			break;

		case 7:
			// informe
			$ico = 'fa fa-clipboard';
			$msj = "Emisión de Informe";
			break;

		case 8:
			// telematicas
			$ico = 'fa fa-tty';
			$msj = "Acción Telemática";
			break;

		case 9:
			// acción grupal
			$ico = 'fa fa-graduation-cap';
			$msj = "Acción Grupal";
			break;

		case 10:
			// coordinacion
			$ico = 'fa fa-comments-o';
			$msj = "Coordinación";
			break;

		case 11:
			// baja
			$ico = 'fa fa-sign-out';
			$msj = "Baja en el Programa";
			break;

		case 12:
			// formacion
			$ico = 'fa fa-graduation-cap';
			$msj = "Acción Formativa";
			break;
	}
?>

<i class="<?= $ico; ?> ico_incidencia icono-fa", 
	id= '<?= $incidencia_id; ?>',
    data-container= "body",
    data-toggle= "popover",
    data-placement= "right",
    data-content= '<?= $msj; ?>'></i>


