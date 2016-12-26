<?php

// Valores alertas si no aparece el expediente en la últimna nómina

	
		$coincide_rgc_alert = '<span class="badge bg-default">RGC</span><i class="fa fa-euro"></i>Cerrado';
		$mensaje_rgc = 'Este expediente no tiene abierta ninguna prestación de RGC.';
		$coincide_aus_alert = '<span class="badge bg-default">AUS</span><i class="fa fa-euro"></i>Cerrado';
		$mensaje_aus = 'Este expediente no tiene abierta ninguna prestación de AUS.';
		$coincide_atfis_alert = '<span class="badge bg-default">ATFIS</span><i class="fa fa-users"></i>Cerrado';
		$mensaje_atfis = 'Este expediente no tiene abierta ninguna prestación de Apoyo Técnico y Familiar para la Inclusión Social con ninguno de sus miembros.';
		$mensaje_cc = '';
		$coincide_cc_alert = '';
		$mensaje_tedis = '';
		$coincide_tedis_alert = '';

		$count_atfis = 0;
		$rgc = FALSE;	


// Alerta de la parrilla

	if (count($expediente->participantes) == $datos_nominas['ultima_nomina']['MIEMBROS'] && $datos_nominas['ultima_nomina']['fechanomina']==$datos_nominas['datos_ultima_nomina']['fechanomina']) { 
		$coincide_participantes_alert = '<span class="badge bg-green">'.count($expediente->participantes).'/'.$datos_nominas['ultima_nomina']['MIEMBROS'].'</span>';
		$mensaje_participantes='La parrilla de esta App tiene el mismo número de personas que la última nómina cargada.';
	}
	else if ($datos_nominas['ultima_nomina']==FALSE || $datos_nominas['ultima_nomina']['fechanomina']!=$datos_nominas['datos_ultima_nomina']['fechanomina']){
		$coincide_participantes_alert = '<span class="badge bg-default">?</span>';		
		$mensaje_participantes='No es posible comparar las parrillas porque este expediente no aparece en la última nómina cargada.' ;
	}
	else {
		$coincide_participantes_alert = '<span class="badge bg-red">'.count($expediente->participantes).'/'.$datos_nominas['ultima_nomina']['MIEMBROS'].'</span>';
		$mensaje_participantes='La parrilla de esta App tiene un número diferente de personas asociadas a este expediente que los que aparecen en la última nómina cargada. Por favor, REVISA LA PARRILLA.' ;
	}

// Alertas de las prestaciones		

	if ($datos_nominas['ultima_nomina']==TRUE && empty($expediente->prestacions  && $datos_nominas['ultima_nomina']['fechanomina']==$datos_nominas['datos_ultima_nomina']['fechanomina'])){
			$coincide_rgc_alert = '<span class="badge bg-red">RGC</span><i class="fa fa-euro"></i>'.$datos_nominas['ultima_nomina']['RGC'];
			$rgc = TRUE;
			$mensaje_rgc = 'Este expediente aparece en la última nómina de RGC cargada, pero NO está abierta la prestación en nuestra APP. Por favor, REVÍSALO.';
		} 

	foreach	($expediente->prestacions as $prestacion){

		if ($prestacion->prestaciontipo->tipo === 'RGC' && $prestacion->prestacionestado->estado === 'Abierta' ) {
			
			$coincide_rgc_alert = '<span class="badge bg-green">RGC</span><i class="fa fa-euro text-success text-sombra-blanca"></i>'.$datos_nominas['ultima_nomina']['RGC'];
			$rgc = TRUE;
			$mensaje_rgc = 'Este expediente aparece en la última nómina de RGC cargada y el número coincide.';


			if ($datos_nominas['ultima_nomina']==FALSE || $datos_nominas['ultima_nomina']['fechanomina']!=$datos_nominas['datos_ultima_nomina']['fechanomina']){
			$coincide_rgc_alert = '<span class="badge bg-red">RGC</span><i class="fa fa-euro"></i>'.$prestacion->numprestacion;
			$rgc = TRUE;
			$mensaje_rgc = 'Este expediente NO aparece en la última nómina de RGC cargada, pero tiene abierta la prestación en nuestra APP. Por favor, REVÍSALO.';
			} elseif($datos_nominas['ultima_nomina']['RGC'] != $prestacion->numprestacion){
				$coincide_rgc_alert = '<span class="badge bg-red">RGC</span><i class="fa fa-euro"></i>'.$datos_nominas['ultima_nomina']['RGC'];
				$rgc = TRUE;
				$mensaje_rgc = 'Este expediente aparece en la última nómina de RGC cargada, pero no está abierta en la app o no coincide el nº de Prestación.Por favor, REVÍSALO.';
			}
		}
		elseif ($datos_nominas['ultima_nomina']==TRUE && $prestacion->prestacionestado->estado === 'Cerrada'  && $datos_nominas['ultima_nomina']['fechanomina']==$datos_nominas['datos_ultima_nomina']['fechanomina']){
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
		
		if ($prestacion->prestaciontipo->tipo === 'ATFIS' && $prestacion->prestacionestado->estado === 'Abierta' ){
			$count_atfis++;
			$fondo = '';
			$coincide_atfis_alert = '<span class="badge bg-green">'.$count_atfis.'/'.count($listado_posibles_titulares_prestacion).'</span><i class="fa fa-angellist text-success text-sombra-blanca"></i>ATFIS';
			$mensaje_atfis ='Este expediente tiene al menos abierta una prestación de Apoyo Técnico y Familiar para la Inclusión Social con alguien de la parrilla. Revisa si hay prestación abierta para todos los derivados.';
		}

	}

// Ajustes adicionales

	if ($rgc === TRUE && $count_atfis===0 && $datos_nominas['ultima_nomina']['fechanomina']==$datos_nominas['datos_ultima_nomina']['fechanomina']){
		$coincide_atfis_alert = '<span class="badge bg-yelow">'.$count_atfis.'/'.count($listado_posibles_titulares_prestacion).'</span><i class="fa fa-angellist"></i>ATFIS';
		$mensaje_atfis = 'Este expediente NO tiene abierta ninguna prestación de Apoyo Técnico y Familiar para la Inclusión Social pero SI aparece en la última nómina de RGC. Por favor revisa si es correcto.';
	}
	
// Alerta de CEAS	
	
	$relacion_ceas = [	'CEAS CENTRO'=> '8'
						,'CEAS MARIANO ANDRÉS'=> '7'
						,'CEAS SAN MAMÉS-LA PALOMERA'=> '10'
						,'CEAS EL EJIDO - SANTA ANA'=> '9'
						,'CEAS PUENTE CASTRO-SAN CLAUDIO'=> '5'
						,'CEAS EL CRUCERO-LA VEGA'=> '2'
						,'CEAS ARMUNIA-OTERUELO-TROBAJO DE CERECEDO'=> '6'
						];


	if (!isset($datos_nominas['ultima_nomina']['CEAS'])){
		$coincide_ceas_alert = '<span class="badge bg-default">CEAS</span><i class="fa fa-building-o text-success text-sombra-blanca"></i>'.substr($listado_ceas[$expediente->ceas],4);
		$mensaje_ceas = 'Este expediente no aparece en la últimna nómina, por lo que no se puede comparar el CEAS.';
	}elseif ($relacion_ceas[$datos_nominas['ultima_nomina']['CEAS']] == $expediente->ceas){
		$coincide_ceas_alert = '<span class="badge bg-green">CEAS</span><i class="fa fa-building-o text-success text-sombra-blanca"></i>'.substr($listado_ceas[$expediente->ceas],4);
		$mensaje_ceas = 'El CEAS coincide con el que aparece en SAUSS.';
	}else{ 
		$coincide_ceas_alert = '<span class="badge bg-red">CEAS</span><i class="fa fa-building-o text-success text-sombra-blanca"></i>'.substr($listado_ceas[$expediente->ceas],4);
		$mensaje_ceas = 'El CEAS NO coincide con el que aparece en SAUSS. Por favor, revísalo.';
	}

// Alerta de Coordinador de Caso
	
	if(isset($listado_roles['CC']['correcto'])){$cc_correcto = count($listado_roles['CC']['correcto']);}else{$cc_correcto = 0;}
	if(isset($listado_roles['CC']['incorrecto'])){$cc_incorrecto = count($listado_roles['CC']['incorrecto']);}else{$cc_incorrecto = 0;}
	$total_cc = $cc_correcto+$cc_incorrecto;
	
	if(isset($listado_roles['CC']['correcto']) && !isset($listado_roles['CC']['incorrecto'])){

		$coincide_cc_alert = '<span class="badge bg-green">'.$cc_correcto.'/'.$total_cc.'</span><i class="fa fa-cc text-success text-sombra-blanca"></i>Coordinador de Caso';
		$mensaje_cc = 'Existe un coordinador de caso del CEAS de referencia asignado al expediente.';
			if($cc_correcto>1){
				$coincide_cc_alert = '<span class="badge bg-yelow">'.$cc_correcto.'/'.$total_cc.'</span><i class="fa fa-cc text-warning text-sombra-blanca"></i>Coordinador de Caso';
				$mensaje_cc = 'Existe más de un coordinador de caso para este expediente. Por favor, revísalo.';
			}
	
	}elseif(isset($listado_roles['CC']['correcto']) && isset($listado_roles['CC']['incorrecto'])){

		$coincide_cc_alert = '<span class="badge bg-yelow">'.$cc_correcto.'/'.$total_cc.'</span><i class="fa fa-cc text-warning text-sombra-blanca"></i>Coordinador de Caso';
		$mensaje_cc = 'Existe más de un coordinador de caso asignado a este expediente. Por favor, revísalo.';
	
	}elseif(!isset($listado_roles['CC']['correcto'])){

		if(isset($listado_roles['CC']['incorrecto'])){

			$coincide_cc_alert = '<span class="badge bg-red">'.$cc_correcto.'/'.$total_cc.'</span><i class="fa fa-cc text-danger text-sombra-blanca"></i>Coordinador de Caso';
			$mensaje_cc = 'El coordinador de caso asociado no pertenece al CEAS de referencia. Por favor, revísalo.';
		
		}else {
			
			$coincide_cc_alert = '<span class="badge bg-red">'.$cc_correcto.'/'.$total_cc.'</span><i class="fa fa-cc text-danger text-sombra-blanca"></i>Coordinador de Caso';
			$mensaje_cc = 'No existe ningún coordinador de caso para este expediente. Por favor, revísalo.';	
		}
	}

// Alerta de TEDIS
	
	if(isset($listado_roles['tedis']['correcto'])){$tedis_correcto = count($listado_roles['tedis']['correcto']);}else{$tedis_correcto = 0;}
	if(isset($listado_roles['tedis']['incorrecto'])){$tedis_incorrecto = count($listado_roles['tedis']['incorrecto']);}else{$tedis_incorrecto = 0;}
	$total_tedis = $tedis_correcto+$tedis_incorrecto;

	if(isset($listado_roles['tedis']['correcto'])){

		if(!isset($listado_roles['tedis']['incorrecto'])){

			$coincide_tedis_alert = '<span class="badge bg-green">'.$tedis_correcto.'/'.$total_tedis.'</span><i class="fa fa-user text-success text-sombra-blanca"></i>TEDIS';
			$mensaje_tedis = 'Existe un tedis de la zona correcta asignado a este expediente.';

		}elseif(isset($listado_roles['tedis']['incorrecto'])){

			$coincide_tedis_alert = '<span class="badge bg-yelow">'.$tedis_correcto.'/'.$total_tedis.'</span><i class="fa fa-user text-warning text-sombra-blanca"></i>TEDIS';
			$mensaje_tedis = 'Existe un tedis de la zona correcta asignado a este expediente, junto con otros técnicos EDIS de la otra zona. Revisa si es correcto.';
		}	
	}elseif(!isset($listado_roles['tedis']['correcto'])){

		if(!isset($listado_roles['tedis']['incorrecto'])){

			$coincide_tedis_alert = '<span class="badge bg-red">Pendiente</span><i class="fa fa-user text-sombra-blanca"></i>TEDIS';
			$mensaje_tedis = 'No existe ningún Técnico EDIS asignado a este expediente.';

		}elseif(isset($listado_roles['tedis']['incorrecto'])){

			$coincide_tedis_alert = '<span class="badge bg-yelow">'.$tedis_correcto.'/'.$total_tedis.'</span><i class="fa fa-user text-warning text-sombra-blanca"></i>TEDIS';
			$mensaje_tedis = 'No existe ningún TEDIS de la zona del actual CEAS de referencia, aunque está asignado a un TEDIS de la otra zona. Revisa si es correcto.';
		}	
	}	


//debug(count($listado_roles['CC']['correcto']));	exit();
//debug($listado_roles['CC']['correcto']);debug($listado_roles['CC']['incorrecto']);exit();

?>

<div>
    <a class="btn btn-app" id = "alerta_participantes", href="#nomina"
    						data-container = "body",
                			data-toggle = "popover",
                			data-placement = "bottom",
                			data-content =	"<?= $mensaje_participantes; ?>">
      	<?= $coincide_participantes_alert; ?>
      <i class="fa fa-users"></i>Parrilla
    </a>

    <a class="btn btn-app" id = "alerta_rgc",
    						data-container = "body", href="#nomina"
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

    <a class="btn btn-app" id = "alerta_ceas",
    						data-container = "body",
                			data-toggle = "popover",
                			data-placement = "bottom",
                			data-content =	"<?= $mensaje_ceas; ?>">
      	<?= $coincide_ceas_alert; ?>      
    </a>

    <a class="btn btn-app" id = "alerta_cc",  href="#tecnicos"
    						data-container = "body",
                			data-toggle = "popover",
                			data-placement = "bottom",
                			data-content =	"<?= $mensaje_cc; ?>">
      	<?= $coincide_cc_alert; ?>      
    </a>

    <a class="btn btn-app" id = "alerta_tedis",  href="#tecnicos"
    						data-container = "body",
                			data-toggle = "popover",
                			data-placement = "bottom",
                			data-content =	"<?= $mensaje_tedis; ?>">
      	<?= $coincide_tedis_alert; ?>      
    </a>
</div>