
<?php if ($datos_nominas['ultima_nomina'] === FALSE ): ?>

	<p class="error-text text-center">Este expediente <b>no aparece</b> en la última nómina cargada (<?= $datos_nominas['datos_ultima_nomina']['fechanomina']; ?>)</p>

<?php else: ?>	
	<?php if ($datos_nominas['ultima_nomina']['fechanomina']!=$datos_nominas['datos_ultima_nomina']['fechanomina'] ): ?>
		<p class="error-text text-center">Este expediente <b>no aparece</b> en la última nómina cargada (<?= $datos_nominas['datos_ultima_nomina']['fechanomina']; ?>)</p>
	<?php else: ?>
		<p class="success-text text-center">Este expediente <b>aparece</b> en la última nómina cargada (<?= $datos_nominas['datos_ultima_nomina']['fechanomina']; ?>)</p> 	 
	<?php endif; ?>

<?php 

	$coincide_numrgc = '';
	$coincide_ceas = '';
	$coincide_direccion = '';
	$coincide_participantes = '';
	$coincide_dni = '';

	$ceas_en_app = ['CEAS CRUCERO', 'CEAS PARQUE DE LOS REYES', 'CEAS ARMUNIA', 'CEAS MARIANO ANDRES (Frontón)', 'CEAS CENTRO', 'CEAS EJIDO', 'CEAS PALOMERA', 'CEAS MARIANO ANDRES (Ventas Este)'];

	$ceas_en_sauss = ['CEAS CENTRO','CEAS MARIANO ANDRÉS','CEAS SAN MAMÉS-LA PALOMERA','CEAS EL EJIDO - SANTA ANA','CEAS PUENTE CASTRO-SAN CLAUDIO','CEAS EL CRUCERO-LA VEGA','CEAS ARMUNIA-OTERUELO-TROBAJO DE CERECEDO'];


		// Buscamos diferencias en el CEAS
		if (($datos_nominas['ultima_nomina']['CEAS'] === 'CEAS ARMUNIA-OTERUELO-TROBAJO DE CERECEDO' && $expediente['ceas'] === '6') ||
			($datos_nominas['ultima_nomina']['CEAS'] === 'CEAS CENTRO' && $expediente['ceas'] === '8') ||
			($datos_nominas['ultima_nomina']['CEAS'] === 'CEAS SAN MAMÉS-LA PALOMERA' && $expediente['ceas'] === '10') ||
			($datos_nominas['ultima_nomina']['CEAS'] === 'CEAS EL EJIDO - SANTA ANA' && $expediente['ceas'] === '9') ||
			($datos_nominas['ultima_nomina']['CEAS'] === 'CEAS PUENTE CASTRO-SAN CLAUDIO' && $expediente['ceas'] === '5') ||
			($datos_nominas['ultima_nomina']['CEAS'] === 'CEAS EL CRUCERO-LA VEGA' && $expediente['ceas'] === '2') ||
			($datos_nominas['ultima_nomina']['CEAS'] === 'CEAS MARIANO ANDRÉS' && $expediente['ceas'] === '7') ||
			($datos_nominas['ultima_nomina']['CEAS'] === 'CEAS MARIANO ANDRÉS' && $expediente['ceas'] === '22') 
			) {$coincide_ceas = '<i class="fa fa-check-square success"></i>';} else {$coincide_ceas = '<i class="fa fa-times error"></i>';}

		if (in_array($datos_nominas['ultima_nomina']['RGC'],$prestaciones_abiertas_rgc)) { $coincide_numrgc = "<i class='fa fa-check-square success'></i>"; $texto_rgc='La prestación de SAUSS coincide con la que tenemos abierta en el sistema: ';} 
		else {$coincide_numrgc = '<i class="fa fa-times error"></i>';$texto_rgc='La prestación de SAUSS <b>NO coincide</b> con la que tenemos abierta en el sistema. La correcta es :';}

		if ( $datos_nominas['ultima_nomina']['DOMICILIO'] === $expediente['domicilio']) {$coincide_direccion = '<i class="fa fa-check-square success"></i>';} 
		else {$coincide_direccion = '<button class="fa fa-share-square-o error" 
												id="cambiar_direccion"
												data-container="body"
								                data-toggle="popover"
								                data-placement="left"
								                data-content="Sustituye la dirección del expediente por la de Sauss."
												></button>';}

		if (count($expediente->participantes) == $datos_nominas['ultima_nomina']['MIEMBROS']) { $coincide_participantes = "<td> <i>El número de usuarios adscritos a este expediente <b>coincide</b> con el expediente en SAUSS</i></td> <td class='text-right'><i class='fa fa-check-square success'></i></td>"; } 
		else {$coincide_participantes = "<td> <i class='alert'>El número de usuarios adscritos a este expediente <b>NO coincide</b> con el del expediente en SAUSS.</i></td> <td class='text-right'><i class='fa fa-times error'></i></td>";}		

?>


    <table class="vertical-table table"> 
		
        <tr>
        	<th>Última nómina en la que aparece este expediente:</th>
        	<td><?= $datos_nominas['ultima_nomina']['fechanomina']; ?></td>
        </tr>
        <tr>
            <th>NÚMERO DE R.G.C.: </th>
            <td><?= $texto_rgc.' <b>'.$datos_nominas['ultima_nomina']['RGC'].'</b>'; ?></td> <td class="text-right"><?= $coincide_numrgc;?></td>
        </tr>   
        <tr>
            <th>CEAS: </th>
            <td><?= $datos_nominas['ultima_nomina']['CEAS']; ?></td> <td class="text-right"><?= $coincide_ceas;?></td>
        </tr>       	
        <tr>
        	<th>DIRECCIÓN: </th>
            <td id="direccion_actual"><?= $datos_nominas['ultima_nomina']['DOMICILIO']; ?></td> <td class="text-right" id="coincide_direccion"><?= $coincide_direccion;?></td>
        </tr>
                <tr>
        	<th>PARTICIPANTES: </th>
            <?= $coincide_participantes;?>
        </tr>

    </table>

    <table class="table">
    	<thead>
    		<tr>
    			<th>DNI/NIE</th>
    			<th>Nombre y Apellidos</th>
    			<th>Sexo</th>
    			<th>Nac.</th>
    			<th>Relación</th>
    			<th>Cargar</th>
    		</tr>
    	</thead>
    	<tbody>

    		<?php foreach ($datos_nominas['participantes_ultima_nomina'] as $participante): ?>

    			<?php if (in_array($participante['dni'], $listado_participantes)): ?>

    					<?php $coincide_dni = 'fila_verde'; ?>
    			
    			<?php elseif (!in_array($participante['dni'], $listado_participantes) &&
    						in_array($participante['nombrecompleto'], $listado_nombres_parrilla)): ?>
    				 	
    				 	<?php $coincide_dni = 'fila_amarilla'; ?>

    			<?php else: ?>

    					<?php $coincide_dni = 'fila_roja'; ?>

    			<?php endif ?>

	    		<tr class="<?= $coincide_dni; ?>">
	    			<td><?= $participante['dni']; ?></td>
	    			<td><?= $participante['nombrecompleto']; ?></td>
	    			<td><?= substr($participante['sexo'],0,1); ?></td>
	    			<td><?= substr($participante['nacionalidad'],0,3); ?></td>
	    			<td><?= $participante['relacion_titular']; ?></td>
	    			<?php if ($coincide_dni === 'fila_roja'): ?>

	    				<?php 
	    					
	    					// Validamos el DNI/NIE

	    						$plantilla_dni = '/^(([X-Z]{1})(\d{7})([A-Z]{1}))|((\d{8})([A-Z]{1}))|((\d{4})-(\d{1}))$/i';
	    						preg_match ($plantilla_dni, $participante['dni'], $coincidencias);
	    						if(!empty($coincidencias)){$datos_dni = $participante['dni']; }
	    						else{
	    							$c=1;
	    							$datos_dni= $expediente['numedis'].'-'.$c;
	    							while (in_array($datos_dni, $listado_participantes)){
	    								$c++;
	    								$datos_dni= $expediente['numedis'].'-'.$c;
	    							}
	    						}

	    					// Separamos nombre y apellidos

	    						$rompe_nombre = explode(" ",$participante['nombrecompleto']);
	    						$palabras = count($rompe_nombre);
	    						$datos_nombre='';
	    						$datos_apellidos = $rompe_nombre[$palabras-2].' '.$rompe_nombre[$palabras-1];
	    						$datos_nombre = $rompe_nombre[0];
	    						for ($i = 1; $i < ($palabras-2); $i++) {
    								$datos_nombre = $datos_nombre.' '.$rompe_nombre[$i];
								}

							// Cargamos el sexo

								switch ($participante['sexo']) {
								    case 'MUJER':
								        $datos_sexo='F';
								        break;

								    case 'VARON':
								        $datos_sexo='M';
								        break;
								}

							// Cargamos las Relaciones

								switch (trim($participante['relacion_titular'])) {
								    
								    case 'COMPAÑERO/A':
								    case 'ESPOSO/A':
								        $datos_relacion='2';
								        break;

								    case 'HIJO/A':
								        $datos_relacion='3';
								        break;

								    case 'MADRE':
								    case 'PADRE':
								        $datos_relacion='4';
								        break;

								    case 'SUEGRO/A':
								        $datos_relacion='5';
								        break;

								    case 'HERMANO/A':
								        $datos_relacion='6';
								        break;

								    case 'NIETO/A':
								        $datos_relacion='7';
								        break;

								    case 'YERNO/NUERA':
								        $datos_relacion='8';
								        break;

								    case 'CUÑADO/A':
								        $datos_relacion='10';
								        break;

								    case 'OTROS':
								        $datos_relacion='9';
								        break;

								    default:
								        $datos_relacion='9';
								        break;									
								}

	    						
//debug ($participante);debug ($rompe_nombre);debug ($datos_nombre.' '.$datos_apellidos);
	    						
	    					$datos_este_participante = [
	    						'dni' => $datos_dni,
	    						'nombre' => $datos_nombre,
	    						'apellidos' => $datos_apellidos,
	    						'sexo' => $datos_sexo,
	    						'relacion' => $datos_relacion
	    					];
//debug ($datos_este_participante);

	    				?>
	    				
	    				<td>
	    					<?= $this->Form->create('participante',['class'=>'form-horizontal form-label-left data-parsley-validate=""']) ?>

	    						<?= $this->Form->input('participantes.dni', ['type'=>'hidden', 'value'=>$datos_este_participante['dni']]);?>
	    						<?= $this->Form->input('participantes.nombre', ['type'=>'hidden', 'value'=>$datos_este_participante['nombre']]);?>
	    						<?= $this->Form->input('participantes.apellidos', ['type'=>'hidden', 'value'=>$datos_este_participante['apellidos']]);?>
	    						<?= $this->Form->input('participantes.sexo', ['type'=>'hidden', 'value'=>$datos_este_participante['sexo']]);?>
	    						<?= $this->Form->input('participantes.relation_id', ['type'=>'hidden', 'value'=>$datos_este_participante['relacion']]);?>
	    						<?= $this->Form->input('participantes.email', ['type'=>'hidden', 'value'=>'']);?>
	    						<?= $this->Form->input('participantes.telefono', ['type'=>'hidden', 'value'=>'']);?>

	    						<?= $this->Form->button('', ['class' => 'fa fa-share-square-o error',
	    														'id'=>'usuario_desde_nomina'.$datos_este_participante['dni'],
	    														'data-container'=>"body",
												                'data-toggle'=>"popover",
												                'data-placement'=>"left",
												                'data-content'=>"Añade a ".$participante['nombrecompleto']." a la parrilla de este expediente."
	    										]) ?>	

	    					<?php echo $this->Form->end(); ?>

	    				</td>


	    			<?php elseif($coincide_dni === 'fila_verde' || $coincide_dni === 'fila_amarilla'): ?>
	    				 <td><i class='fa fa-check-square success'></i> </td>	 
	    			<?php endif; ?>
	    			
	    		</tr>
    		<?php endforeach ?>

    	</tbody>
    </table>

<?php endif ?> <!-- FIN else si exixte en la última nómina-->
