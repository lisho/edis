
<div class="cabecera_informe">
	<div class="titulo_informe" id="titulo">
		<strong>INFORME DE SEGUIMIENTO</strong>		

	</div>

	<div class="subtitulo_informe">
		<h2 class="centrado titulo">Equipos de Inclusión Social <strong>- E.D.I.S. <?= $informe->user->equipo->aas;?> -</strong></h2>
		<hr>
		<table class="table">
			<tr>
				<td class="centrado">Expediente EDIS</td>
				<td class="centrado">Num. Historia Social</td>
			</tr>
			
			<tr>
				<td><big><strong> <?= $informe->expediente->numedis;?></strong></big></td>
				<td><big><strong> <?= $informe->expediente->numhs;?></strong></big></td>
			</tr>
		</table>		
	</div>	
</div>

<h3 id="fecha_informe">Fecha de emisión: <strong><?= $this->Time->format($informe->fecha, "dd/MM/yyyy", null);?></strong></h3>

<div class="block">
	<br>
	<h2>Datos del Expediente</h2><hr>
	<div class="alinear_derecha">
		<p>Expediente de Renta Garantizada de Ciudadanía:<big><strong><?= '  '.$prestacion_rgc->numprestacion;?></strong></big> </p>
	</div>

	<p><big><strong>CEAS de Referencia:</strong><?= '  '.$ceas->nombre;?></big> </p>
	<p><big><strong>Domicilio de Contacto:</strong><?= '  '.$informe->expediente->domicilio;?></big></p>
	
	<div>
		<p><big><strong>Titular del expediente de RGC:</strong></big></p>
		<table  class="table">
			<thead>
				<tr>
					<th>DNI/NIE</th>
					<th>Nombre</th>
					<th>Apellidos</th>
					<th>Fecha de Nacimiento</th>
				</tr>			
			</thead>
			<tbody>
				<tr>
					<td><?= $prestacion_rgc->participante->dni; ?></td>
					<td><?= $prestacion_rgc['participante']['nombre']; ?></td>
					<td><?= $prestacion_rgc->participante->apellidos; ?></td>
					<td><?= $this->Time->format($prestacion_rgc->participante->nacimiento, "dd/MM/yyyy", null); ?></td>
				</tr>
			</tbody>
		</table>	
	</div>
	
	<div>
		<p><big><strong>Parrilla familiar:</strong></big></p>
		<table  class="table">
			<thead>
				<tr>
					<th>Relación</th>
					<th>DNI/NIE</th>
					<th>Nombre</th>
					<th>Apellidos</th>
					<th>Fecha de Nacimiento</th>
				</tr>			
			</thead>
			<tbody>
				<?php foreach($informe->expediente->participantes as $participante): ?>
					<?php if ($participante->dni != $prestacion_rgc->participante->dni): ?>
						<tr>
							<td><?= $participante-> relation ->nombre; ?></td>
							<td><?= $participante-> dni; ?></td>
							<td><?= $participante -> nombre; ?></td>
							<td><?= $participante-> apellidos; ?></td>
							<td><?= $this->Time->format($participante->nacimiento, "dd/MM/yyyy", null); ?></td>
						</tr>  	 
					<?php endif; ?>
				<?php endforeach; ?>
			</tbody>
		</table>	
	</div>

	<div class="justificado sangrado">
		<h2>Antecedentes</h2><hr>
		<?= $informe->antecedentes; ?>
	</div>

	<div class="justificado sangrado">
		<h2>Situación actual</h2><hr>
		<?= $informe->situacion; ?>
	</div>

	<div class="justificado sangrado">
		<h2>Proyecto Individualizado de Inserción (PII)</h2><hr>
		<?= $informe->pii; ?>
	</div>

	<div class="justificado sangrado">
		<h2>Valoración Técnica</h2><hr>
		<?= $informe->valoracion; ?>
	</div>

	<div>
		<?= $informe->propuesta; ?>
	</div>

	<br>	
	<p class="centrado">En León, a <?= $this->Time->Format($informe->fecha, "dd' de 'MMMM' de 'yyyy", null);?>. </p>

	<div class="firma">
		<p><strong><?= $informe->user->nombre.' '.$informe->user->apellidos; ?></strong></p>
		<P><?= $tedis->puesto.' - Equipos de Inclusión Social <strong>- E.D.I.S.'. $informe->user->equipo->aas;?></P>
		<p>Ayuntamiento de León</p>
	</div>
</div>
	
