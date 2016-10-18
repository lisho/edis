<?php

// Valores alertas si no aparece el expediente en la últimna nómina


		$coincide_rgc_alert = '<span class="badge bg-default">RGC</span><i class="fa fa-euro"></i>Cerrado';
		$mensaje_rgc = 'Este expediente no tiene abierta ninguna prestación de RGC.';
		$coincide_aus_alert = '<span class="badge bg-default">AUS</span><i class="fa fa-euro"></i>Cerrado';
		$mensaje_aus = 'Este expediente no tiene abierta ninguna prestación de AUS.';
		$coincide_atfis_alert = '<span class="badge bg-default">ATFIS</span><i class="fa fa-users"></i>Cerrado';
		$mensaje_atfis = 'Este expediente no tiene abierta ninguna prestación de Apoyo Técnico y Familiar para la Inclusión Social con ninguno de sus miembros.';
		$count_atfis = 0;
		$rgc = FALSE;	

// Alerta de la parrilla

	if (count($expediente->participantes) === $datos_nominas['ultima_nomina']['MIEMBROS']) { 
		$coincide_participantes_alert = '<span class="badge bg-green">'.$datos_nominas['ultima_nomina']['MIEMBROS'].'</span>';
		$mensaje_participantes='La parrilla de esta App tiene el mismo número de personas que la última nómina cargada.';
	}
	else if ($datos_nominas['ultima_nomina']==FALSE){
		$coincide_participantes_alert = '<span class="badge bg-default">?</span>';		
		$mensaje_participantes='No es posible comparar las parrillas porque este expediente no aparece en la última nómina cargada.' ;
	}
	else {
		$coincide_participantes_alert = '<span class="badge bg-red">'.$datos_nominas['ultima_nomina']['MIEMBROS'].'</span>';
		$mensaje_participantes='La parrilla de esta App tiene un número diferente de personas asociadas a este expediente que los que aparecen en la última nómina cargada. Por favor, REVISA LA PARRILLA.' ;
	}

// Alertas de las prestaciones		

	foreach	($expediente->prestacions as $prestacion){

		if ($prestacion->prestaciontipo->tipo === 'RGC' && $prestacion->prestacionestado->estado === 'Abierta') {
			
			$coincide_rgc_alert = '<span class="badge bg-green">RGC</span><i class="fa fa-euro text-success text-sombra-blanca"></i>'.$datos_nominas['ultima_nomina']['RGC'];
			$rgc = TRUE;
			$mensaje_rgc = 'Este expediente aparece en la última nómina de RGC cargada y los datos coinciden.';


			if ($datos_nominas['ultima_nomina']==FALSE){
			$coincide_rgc_alert = '<span class="badge bg-red">RGC</span><i class="fa fa-euro"></i>'.$prestacion->numprestacion;
			$rgc = TRUE;
			$mensaje_rgc = 'Este expediente NO aparece en la última nómina de RGC cargada, pero tiene abierta la prestación en nuestra APP. Por favor, REVÍSALO.';
			} 
			elseif($datos_nominas['ultima_nomina']['RGC'] != $prestacion->numprestacion){
				$coincide_rgc_alert = '<span class="badge bg-red">RGC</span><i class="fa fa-euro"></i>'.$datos_nominas['ultima_nomina']['RGC'];
				$rgc = TRUE;
				$mensaje_rgc = 'Este expediente aparece en la última nómina de RGC cargada, pero no está abierta en la app o no coincide el nº de Prestación.Por favor, REVÍSALO.';
			}
		}
		elseif ($datos_nominas['ultima_nomina']==TRUE && $prestacion->prestacionestado->estado === 'Cerrada'){
			$coincide_rgc_alert = '<span class="badge bg-primary">RGC</span><i class="fa fa-euro"></i>'.$prestacion->numprestacion;
			$rgc = TRUE;
			$mensaje_rgc = 'Este expediente aparece en la última nómina de RGC cargada, pero NO está abierta la prestación en nuestra APP. Por favor, REVÍSALO.';
		} 
		elseif ($prestacion->prestaciontipo->tipo === 'RGC' && $prestacion->prestacionestado->estado === 'Pendiente de cobro'){
			$coincide_rgc_alert = '<span class="badge bg-yelow">RGC</span><i class="fa fa-euro"></i>'.$prestacion->numprestacion;
			$rgc = TRUE;
			$mensaje_rgc = 'Este expediente NO aparece en la última nómina de RGC cargada, pero ya ha pasado por comisión y está en espera de cobro.';
		} 
		

		if ($prestacion->prestaciontipo->tipo === 'AUS' && $prestacion->prestacionestado->estado === 'Abierta'){
			$coincide_aus_alert = '<span class="badge bg-green">AUS</span><i class="fa fa-euro text-success text-sombra-blanca"></i>$prestacion->numprestacion';
			$mensaje_aus = 'Este expediente tiene abierta una prestación de AUS.';
		}
		
		if ($prestacion->prestaciontipo->tipo === 'ATFIS' && $prestacion->prestacionestado->estado === 'Abierta'){
			$count_atfis++;
			$fondo = '';
			$coincide_atfis_alert = '<span class="badge bg-green">'.$count_atfis.'/'.count($listado_posibles_titulares_prestacion).'</span><i class="fa fa-angellist text-success text-sombra-blanca"></i>ATFIS';
			$mensaje_atfis ='Este expediente tiene al menos abierta una prestación de Apoyo Técnico y Familiar para la Inclusión Social con alguien de la parrilla. Revisa si hay prestación abierta para todos los derivados.';
		}

	}

// Ajustes adicionales

	if ($rgc === TRUE && $count_atfis===0){
		$coincide_atfis_alert = '<span class="badge bg-yelow">'.$count_atfis.'/'.count($listado_posibles_titulares_prestacion).'</span><i class="fa fa-angellist"></i>ATFIS';
		$mensaje_atfis = 'Este expediente NO tiene abierta ninguna prestación de Apoyo Técnico y Familiar para la Inclusión Social pero SI aparece en la última nómina de RGC. POr favor sevisa si es correcto.';
	}
	
	
	


?>


<div>
    <a class="btn btn-app" id = "alerta_participantes",
    						data-container = "body",
                			data-toggle = "popover",
                			data-placement = "bottom",
                			data-content =	"<?= $mensaje_participantes; ?>">
      	<?= $coincide_participantes_alert; ?>
      <i class="fa fa-users"></i>Parrilla
    </a>

    <a class="btn btn-app" id = "alerta_rgc",
    						data-container = "body",
                			data-toggle = "popover",
                			data-placement = "bottom",
                			data-content =	"<?= $mensaje_rgc; ?>">
      	<?= $coincide_rgc_alert; ?>      
    </a>

    <a class="btn btn-app" id = "alerta_aus",
    						data-container = "body",
                			data-toggle = "popover",
                			data-placement = "bottom",
                			data-content =	"<?= $mensaje_aus; ?>">
      	<?= $coincide_aus_alert; ?>      
    </a>

    <a class="btn btn-app" id = "alerta_atfis",
    						data-container = "body",
                			data-toggle = "popover",
                			data-placement = "bottom",
                			data-content =	"<?= $mensaje_atfis; ?>">
      	<?= $coincide_atfis_alert; ?>      
    </a>
</div>