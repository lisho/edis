

<div class="cabecera"> <strong>FAMILIA Y SERVICIOS SOCIALES</strong></div>
<h3 class="centrado titulo">Plantilla para Comisión de Ayudas de Urgencia Social</h3>
<div >
	<h3 class="centrado"> <strong><?= $this->Time->Format($comision->fecha, "dd' de 'MMMM' de 'yyyy", null);?></strong></h3>
</div>
<br>
	<?php $i=0; ?>

<h2>Expedientes</h2>
<hr>

<?php foreach ($expedientes_ordenados as $key => $ceas): ?>

    <h3><?= $listado_ceas[$key]; ?></h3>
        <table class="table">
            <thead>
                <tr class="titulo">

                    <th>Num. HS</th>
                    <th>Titular</th>
                    <th>DNI/NIE</th>  
                    <th>TEDIS</th>                 
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ceas as $pasacomision): ?>

                    <tr class="fila">

                            <?php foreach ($pasacomision->expediente->prestacions as $prestacion): ?>   
                                <?php if ($prestacion->prestaciontipo->tipo === 'AUS' && $prestacion->cierre === null): ?>

                                <!-- <td><?= $pasacomision->expediente->numhs; ?></td>  -->
                                <td><?= $pasacomision->expediente->numhs; ?></td> 
                                <td class="mayusculas">
                                	
                                	<?= $prestacion->participante->nombre.' '.$prestacion->participante->apellidos; ?> <!-- Recogemos el nombre de la prestación de RGC -->
                                </td>   
                        		<?php endif; ?>
                    		<?php endforeach ?>
                        	  
                        <td>
                        	<?php foreach ($pasacomision->expediente->participantes as $participante): ?>
                                <?php if($participante->relation_id=='1'){ echo $participante->dni; }?>
                            <?php endforeach ?>
                        </td>   

                        <td>
                            <?php foreach ($pasacomision->expediente->roles as $rol): ?>
                                <?php if($rol->rol=='tedis'){ echo $rol['tecnico']['nombre'].' '.$rol['tecnico']['apellidos']; }?>
                            <?php endforeach ?>
                        </td>
                        
                    </tr>


                <?php endforeach ?>

            </tbody>
        </table>
        <br><br>
<?php endforeach ?>

</div>