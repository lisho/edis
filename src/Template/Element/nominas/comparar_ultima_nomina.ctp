
<?php if ($datos_nominas['ultima_nomina'] === FALSE): ?>

	<p class='error-text text-center'>Este expediente <b>no aparece</b> en la última nómina cargada</p>

<?php else: ?>	


<?php 
	
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

		if ( $datos_nominas['ultima_nomina']['DOMICILIO'] === $expediente['domicilio']) {$coincide_direccion = '<i class="fa fa-check-square success"></i>';} 
		else {$coincide_direccion = '<i class="fa fa-times error"></i>';}

		if (count($expediente->participantes) == $datos_nominas['ultima_nomina']['MIEMBROS']) { $coincide_participantes = "<td> <i class='success'>El número de usuarios adscritos a este expediente <b>coincide</b> con el expediente en SAUSS</i></td> <td class='text-right'><i class='fa fa-check-square success'></i></td>"; } 
		else {$coincide_participantes = "<td> <i class='alert'>El número de usuarios adscritos a este expediente <b>NO coincide</b> con el del expediente en SAUSS.</i></td> <td class='text-right'><i class='fa fa-times error'></i></td>";}
		


		//if ($datos_nominas['ultima_nomina']['CEAS'] === $) {}

		//debug($datos_nominas['ultima_nomina']['MIEMBROS']);
		//exit();

?>


    <table class="vertical-table table"> 
		
        <tr>
            <th>CEAS: </th>
            <td><?= $datos_nominas['ultima_nomina']['CEAS']; ?></td> <td class="text-right"><?= $coincide_ceas;?></td>
        </tr>       	
        <tr>
        	<th>DIRECCIÓN: </th>
            <td><?= $datos_nominas['ultima_nomina']['DOMICILIO']; ?></td> <td class="text-right"><?= $coincide_direccion;?></td>
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
    		</tr>
    	</thead>
    	<tbody>

    		<?php foreach ($datos_nominas['participantes_ultima_nomina'] as $participante): ?>

    			<?php if (in_array($participante['dni'], $listado_participantes) ): ?>
    					<?php $coincide_dni = 'fila_verde'; ?>
    			<?php else: ?>
    					<?php $coincide_dni = 'fila_roja'; ?>
    			<?php endif ?>

	    		<tr class="<?= $coincide_dni; ?>">
	    			<td><?= $participante['dni']; ?></td>
	    			<td><?= $participante['nombrecompleto']; ?></td>
	    			<td><?= substr($participante['sexo'],0,1); ?></td>
	    			<td><?= substr($participante['nacionalidad'],0,3); ?></td>
	    			<td><?= $participante['relacion_titular']; ?></td>
	    		</tr>
    		<?php endforeach ?>

    	</tbody>
    </table>

<?php endif ?> <!-- FIN else si exixte en la última nómina-->
