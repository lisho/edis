

<div class="cabecera"> <strong>FAMILIA Y SERVICIOS SOCIALES</strong></div>
<h3 class="centrado titulo">Acta de Comisión Técnica de Valoración y Seguimiento de R.G.C.</h3>
<div >
	<p class="justificado">En cumplimiento de lo establecido en el artículo 17 en su punto 4 del Decreto 61/2010, de 16 de diciembre, por el que se aprueba el Reglamento de desarrollo y Aplicación de la Renta Garantizada de Ciudadanía, el Ayuntamiento de León acordó la creación de la Comisión Técnica para la valoración y el seguimiento de la Renta Garantizada de Ciudadanía en la cual se valoran, por el conjunto de los profesionales técnicos que intervienen en Inclusión Social, los proyectos individualizados de inserción (PII) relacionados con dicha prestación. </p>
	<p class="justificado">Por todo lo anterior, en la reunión de dicha Comisión que tuvo lugar el día <strong><?= $this->Time->Format($comision->fecha, "dd' de 'MMMM' de 'yyyy", null);?></strong>, y con las asistencias que a continuación se enumeran, se valoraron y se consensuaron los PII en relación a los expedientes reflejados en este documento, en cumplimiento de lo recogido en la normativa que regula dicha prestación. </p>
</div>
<br>
	<?php $i=0; ?>
<h2>Asistentes</h2>	
<hr>
		<table class=" table none">
			<tbody>
				<tr>
				<?php foreach ($comision->asistentecomisions as $asistente): ?>
					<?php if ($i<2): ?>
						<td><?= '<span><strong>'.$asistente->tecnico->nombre.' '.$asistente->tecnico->apellidos.'<strong></span><br><span><small>'.$asistente->tecnico->equipo->nombre.'</small></span>';
								?></td>	
								<?php $i++; ?>			
		
					<?php else: ?>
							<td><?= '<span><strong>'.$asistente->tecnico->nombre.' '.$asistente->tecnico->apellidos.'</strong></span><br><span><small>'.$asistente->tecnico->equipo->nombre.'</small></span>';
								?></td>
								</tr><tr>
								<?php $i=0; ?>
					<?php endif ?>
				<?php endforeach ?>	
				</tr>
			</tbody>
		</table>
	
<br><br>
<h2>Expedientes</h2>
<hr>

<?php foreach ($expedientes_ordenados as $key => $ceas): ?>

    <h3><?= $listado_ceas[$key]; ?></h3>
        <table class="table">
            <thead>
                <tr class="titulo">
                    <th>Docum.</th>
                    <th>Motivo</th>
                    <th>Clasif.</th>
                    <th>NumHS</th>
                    <th>Titular</th>
                    <th>DNI/NIE</th>                   
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ceas as $pasacomision): ?>

                    <tr class="fila">
                    	<td>
                            <?php if ($pasacomision->informeedis==1){echo '<span class="label label-warning">IE</span>';}
                                    else{echo '<span class="label label-default">IE</span>';} ?>
                                       
                            <?php if ($pasacomision->diligencia==1){echo '<span class="label label-warning">D</span>';}
                                    else{echo '<span class="label label-default">D</span>';} ?>

                        </td>  
                        <td><?= $pasacomision->motivo; ?></td>
                        <td><?= $pasacomision->clasificacion; ?></td> 
                        <td><?= $pasacomision->expediente->numhs; ?></td>   
                        <td>
                            <?php foreach ($pasacomision->expediente->participantes as $participante): ?>
                                <?php if($participante->relation_id=='1'){ echo $participante->nombre.' '.$participante->apellidos; }?>
                            <?php endforeach ?>

                        </td>		  
                        <td>
                        	<?php foreach ($pasacomision->expediente->participantes as $participante): ?>
                                <?php if($participante->relation_id=='1'){ echo $participante->dni; }?>
                            <?php endforeach ?>
                        </td>   
                        
                    </tr>


                <?php endforeach ?>

            </tbody>
        </table>
        <br><br>
<?php endforeach ?>

<div >
		<div class="cuadro">
			<p class="justificado"><strong>El Equipo de Inclusión Social ha informado verbalmente de las revisiones en las que no se adjunta informe de seguimiento</strong></p>
			<p class="justificado"> > Documentación que se adjunta (IE = Informe Seguimiento EDIS; D = Diligencia).</p>
			<p class="justificado"> > Motivo de paso por Comisión (INI = Inicial; ROF = Revisión de Oficio; RIP = Revisión a Instancia de Parte)</p>
			<p class="justificado"> > Capficación de Exclusión (C = Coyuntural; E = Estructural)</p>	
		</div>
	<br>	
	<p class="centrado">En León, a <?= $this->Time->Format($comision->fecha, "dd' de 'MMMM' de 'yyyy", null);?>. </p>
	<p class="centrado">Secretaría de la Comisión Técnica para la Valoración y Seguimiento de la Renta Garantizada de Ciudadanía.</p>

	<div class="firma">
		<p><strong><?= $el_secretario->nombre.' '.$el_secretario->apellidos; ?></strong></p>
		<P><?= $el_secretario->puesto.' - Equipos de inclusión Social ('.$el_secretario->equipo->nombre.')'; ?></P>
		<p>Ayuntamiento de León</p>
	</div>
	<br><br><br>
	<p><strong>GERENCIA TERRITORIAL DE SERVICIOS SOCIALES DE LEÓN</strong></p>
	<p><strong>RENTA GARANTIZADA DE CIUDADANÍA</strong></p>
</div>