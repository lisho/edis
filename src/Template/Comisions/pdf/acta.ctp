<h1>ACTA DE COMISION </h1>

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