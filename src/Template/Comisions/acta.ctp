<?php foreach ($expedientes_ordenados as $key => $ceas): ?>

    <h3><?= $listado_ceas[$key]; ?></h3>
        <table class="table">
            <thead>
                <tr class="titulo">
                    <th>Motivo</th>
                    <th>Clasif.</th>
                    <th>Numedis</th>
                    <th>NumHS</th>
                    <th>Titular</th>
                    <th>Observ.</th>
                    <th>Docum.</th>
                    <th></th>
                    
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ceas as $pasacomision): ?>

                    <tr class="fila">
                        <td><?= $pasacomision->motivo; ?></td>
                        <td><?= $pasacomision->clasificacion; ?></td>   
                        <td><?= $pasacomision->expediente->numedis; ?></td>   
                        <td><?= $pasacomision->expediente->numhs; ?></td>   
                        <td>
                            <?php foreach ($pasacomision->expediente->participantes as $participante): ?>
                                <?php if($participante->relation_id=='1'){ echo $participante->nombre.' '.$participante->apellidos; }?>
                            <?php endforeach ?>

                        </td>   
                        <td><?= $pasacomision->observaciones; ?></td>   
                        <td>
                            <?php if ($pasacomision->informeedis==1){echo '<span class="label label-warning">IE</span>';}
                                    else{echo '<span class="label label-default">IE</span>';} ?>
                                       
                            <?php if ($pasacomision->diligencia==1){echo '<span class="label label-warning">D</span>';}
                                    else{echo '<span class="label label-default">D</span>';} ?>

                        </td>  
                        <td>
                            <?= $this->Html->link('', ['controller' =>'Pasacomisions','action' => 'edit', $pasacomision->id], ['class'=> 'fa fa-edit']) ?> 
                            <?= $this->Form->postLink('', ['controller' =>'Pasacomisions', 'action' => 'delete', $pasacomision->id], ['class'=> 'fa fa-trash', 'confirm' => '¿Realmente quieres eliminar este expediente de esta comisión?']); ?> 

                        </td> 
                    </tr>


                <?php endforeach ?>

            </tbody>
        </table>
<?php endforeach ?>