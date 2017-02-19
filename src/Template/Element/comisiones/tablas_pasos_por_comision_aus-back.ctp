
    <tr>
        <td><?= "AUS"; ?></td>
        <td><strong><?= $this->Html->link($pasacomision->expediente->numedis, ['controller'=>'Expedientes', 'action'=>'view', $pasacomision->expediente->id], ['target' => '_blank']); ?></strong></td>
        <td>
            
            <?php if ($pasacomision->expediente->numhs !=''): ?>
                    <?= $pasacomision->expediente->numhs; ?>
            <?php else: ?>
                    <?= $this->Html->link('+HS', '#', [     
                            'class'=> 'btn btn-xs modal-btn btn-danger fa sin_prestacion',
                            'id'=>$modificador.'crear_hs'.$pasacomision->id,
                            //'data-expediente' => $pasacomision->expediente->id,
                            'data-container'=>"body",
                            'data-toggle'=>"popover",
                            'data-placement'=>"top",
                            'data-content'=>"No tenemos la Historia Social de este expediente. Por favor, añádela."]); ?>  
            
            <!-- MODAL Añadir Historia Social -->
                <div id="modal_<?= $modificador; ?>crear_hs<?= $pasacomision->id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                    <h4 class="modal-title" id="myModalLabel">Añade el número de Historia Social al Expediente <strong><?= $pasacomision->expediente['numedis']?></strong></h4>
                                </div>
                                <div class="modal-body">
                                   
                                    <?= $this->Form->create($pasacomision->expediente, ['url' =>['controller' => 'Expedientes', 'action' => 'edit']], ['class'=>'form-horizontal form-label-left data-parsley-validate=""']) ?>

                                     <?php
                                        echo $this->Form->input('desde', [
                                                'type' => 'hidden',
                                                'value' => 'comision',
                                                'label' => ['text' => '']
                                            ]);
                                    ?>    

                                    <div class="form-group has-feedback">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Número de Prestación <span class="required">*</span></label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <?php
                                                echo $this->Form->input('numhs', [
                                                        'class'=>'form-control col-md-7 col-xs-12',
                                                        'required' => 'required',
                                                        'label' => ['text' => '']
                                                    ]);
                                            ?> 
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <?= $this->Form->button('Añadir Historia Social ->', ['class' => 'btn btn-success']) ?>
                                    <?= $this->Html->link('Cerrar', ['action'=>'index'],['class' => 'btn btn-primary','data-dismiss'=>"modal"]) ?>
                                    
                                </div>
                                   
                                    <?= $this->Form->end() ?>
                            </div>

                    </div>
                </div>   

            <?php endif; ?>   
        </td>   
        <td>
            
            <?php $p = 'no'; ?> <!-- Partimos de que no existe prestación abierta de AUS -->
            <?php $atfis = 'no'; ?> <!-- Recogemos la existencia de una prestación abierta de ATFIS -->
            <?php $atfis_num = 0; ?>
            <?php $titular = ''; ?> 
            
            <?php foreach ($pasacomision->expediente->prestacions as $prestacion): ?>

                    <?php if ($prestacion->prestaciontipo->tipo === 'ATFIS' && $prestacion->cierre === null): ?>

                        <?php $atfis = 'si'; $atfis_num++?> <!-- Recogemos la existencia de una prestación abierta de ATFIS -->

                    <?php endif; ?>

                    <?php if ($prestacion->prestaciontipo->tipo === 'AUS' && $prestacion->cierre === null): ?>
                        <?php $p = 'si'; ?> <!-- Recogemos la existencia de una prestación abierta de AUS -->

                         <!-- No está en nomina - codigo de color ?? -->
                        <?php if ($prestacion->prestacionestado->estado === 'Pendiente de cobro'){ $btn = ' btn-warning ';} else if ($prestacion->prestacionestado->estado === 'Abierta') {$btn = ' btn-success ';} ?>


                        <?php $titular = $prestacion->participante->nombre.' '.$prestacion->participante->apellidos; ?> <!-- Recogemos el nombre de la prestación de AUS -->
                        <!-- Existe Prestacion AUS sin cerrar ?? -->

                            <p>
                                <?= $this->Html->link(' '.$prestacion->numprestacion, '#', [     
                                        'class'=> 'btn btn-xs modal-btn'.$btn.'fa blond sombra',
                                        'id'=>$modificador.'ver_info_prestacion'. $pasacomision->id,
                                        'data-container'=>"body",
                                        'data-toggle'=>"popover",
                                        'data-placement'=>"top",
                                        'data-content'=>"Información de la prestación asociada a este paso por comisión."]); ?> 
                            </p>

   <!-- MODAL Datos de la Prestación  -->  

                                    <div id="modal_<?= $modificador; ?>ver_info_prestacion<?= $pasacomision->id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">

                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                                        <h3 class="modal-title" id="myModalLabel">Datos de la Prestación de RGC</h3>
                                                    </div>
                                                    <div class="modal-body">

                                                        <?php if($pasacomision->motivo === 'INI'){$p_estado = 1; $motivo_paso = 'INICIAL'; }
                                                                else if ($pasacomision->motivo === 'RIP'){$p_estado = 5; $motivo_paso = 'Revisión a Instancia de Parte (RIP)';}
                                                                else if ($pasacomision->motivo === 'ROF'){$p_estado = 5; $motivo_paso = 'Revisión de Oficio (ROF)';} ?>

                                                        <p>Datos de la <strong>Prestación de RGC</strong> asociada a este expediente y que motiva este paso por comisión como <strong><?= $motivo_paso;?></strong></p>
                                                        
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th class=" centrar">Exp. EDIS</th>
                                                                    <th class=" centrar">Num. HS</th>
                                                                    <th class=" centrar">Num. AUS</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr class=" centrar">
                                                                    <td><span class="icono-fa"><?= $pasacomision->expediente['numedis']?></span></td>
                                                                    <td><span class="icono-fa"><?= $pasacomision->expediente['numhs']; ?></span></td>
                                                                    <td class="max-width-60"><span class="icono-fa"><strong><?= $prestacion->numprestacion; ?>  </strong></span>
                                                                        <?php $mensaje = 'Cerrada la prestación desde la comisión de RGC';?>
                                                                        <?= $this->Form->postLink('', ['controller'=>'Prestacions', 'action'=>'cerrar-prestacion', $prestacion->id, $mensaje], ['class'=> 'btn btn-xs btn-danger fa fa-lock sombra', 'confirm' => '¿Realmente quieres cerrar esta prestación?', 
                                                                            'id' => 'borra_prestacion_'.$prestacion->id,
                                                                            'data-toggle'=>"popover",
                                                                            'data-placement'=>"top",
                                                                            'data-content'=>"Si esta Prestación no coincide con la que aparece en la mesa de tareas de CEAS para la valoración, puedes cerrarla desde aquí y crear una nueva desde la parrilla de la comisión."]) ?> 
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                        <ul>
                                                                <?php  
                                                                        switch ($prestacion->prestacionestado->estado){
                                                                            case 'Abierta': 
                                                                                $estado_class = 'success icino-fa';
                                                                                break;
                                                                            case 'Pendiente de cobro':
                                                                                $estado_class = 'warning icino-fa';
                                                                                break;
                                                                        }

                                                                ?>
                                                            <li><strong>Estado: </strong><span class="<?php echo $estado_class; ?>"><?= $prestacion->prestacionestado->estado; ?></span></li>
                                                            <li><strong>Titular de la prestación: </strong><span class="text-uppercase"><?= $titular; ?></span> </li>
                                                            <li><strong>Fecha de apertura: </strong><?= $prestacion->apertura; ?></li>
                                                            <li><strong>Fecha de cierre: </strong> ---</li>
                                                            <li><strong>Observaciones: </strong> <?= $prestacion->observaciones; ?> </li>  
                                                        </ul>
                                                        <hr>
                                                        <h4><small>Titular del Expediente: </small><span class="text-uppercase"><?= array_values($listado_posibles_titulares_prestacion[$pasacomision->expediente->id])[0]; ?></span></h4>

                                                </div>
                                        </div>
                                    </div>   
                            
                            
                                    
                    <?php endif; ?>

            <?php endforeach ?>
                     
                
                <?php if ($p==='no'): ?>
           
                    <?= $this->Html->link('+ AUS', '#', [     
                                        'class'=> 'btn btn-xs modal-btn btn-danger fa sin_prestacion',
                                        'id'=>$modificador.'crear_prestacion_rgc'.$pasacomision->id,
                                        //'data-expediente' => $pasacomision->expediente->id,
                                        'data-container'=>"body",
                                        'data-toggle'=>"popover",
                                        'data-placement'=>"top",
                                        'data-content'=>"No existe Prestación de AUS abierta asociada a este expediente. Debemos crearla"]); ?> 
                

    <!-- MODAL Crear prestación -->
                <div id="modal_<?= $modificador; ?>crear_prestacion_rgc<?= $pasacomision->id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                    <h4 class="modal-title" id="myModalLabel">Añade una nueva Prestación de <strong>AUS</strong> a este expediente <strong><?= $pasacomision->expediente['numedis']?></strong></h4>
                                </div>
                                <div class="modal-body">
                                    <p>Cada paso por comisión necesita una prestación de AUS de referencia. Si no existe en nuestro sistema debemos crearla...</p>
                                    <p>Por defecto, crearemos una nueva prestación asumiendo los siguientes datos (si alguno no es correcto deberás cambiarlo una vez creada la prestación):</p>

                                    <?php $p_estado = 5; ?>  <!-- Adjudicamos por defecto a la prestación el estado de abierta -->

                                    <ul>
                                        <li><strong>Estado de la prestación: </strong><?= $estados_comision[$p_estado]; ?></li>
                                        <li><strong>Fecha de apertura: </strong><?= date("d/m/Y"); ?></li>
                                        <li><strong>Fecha de cierre: </strong> ---</li>
                                    </ul>
                                    <br>
                                    <p>Rellena los siguientes datos para completar la creación de la prestación:</p>
                                    <?= $this->Form->create($nueva_prestacion, ['class'=>'form-horizontal form-label-left data-parsley-validate=""']) ?>

                                    <?php
                                        echo $this->Form->input('prestacions.expediente_id', [
                                                'type' => 'hidden',
                                                'value' => $pasacomision->expediente->id,
                                                'label' => ['text' => '']
                                            ]);
                                    ?> 

                                    <?php
                                        echo $this->Form->input('prestacions.prestaciontipo_id', [
                                                'type' => 'hidden',
                                                'value' => 2,
                                                'label' => ['text' => '']
                                            ]);
                                    ?> 

                                    <?php

                                        echo $this->Form->input('prestacions.prestacionestado_id', [
                                                'type' => 'hidden',
                                                'value' => $p_estado,
                                                'label' => ['text' => '']
                                            ]);
                                    ?> 

                                    <?php
                                        echo $this->Form->input('prestacions.apertura', [
                                                'type' => 'hidden',
                                                'value' => date("d/m/Y"),
                                                'label' => ['text' => '']
                                            ]);
                                    ?> 

                                    <?php
                                        echo $this->Form->input('prestacions.numprestacion', [
                                                'class'=>'form-control col-md-7 col-xs-12 hidden',
                                                'value' => 'AUS-'.$pasacomision->expediente->numedis,
                                                'label' => ['text' => '']
                                            ]);
                                    ?> 

                                    <div class="form-group has-feedback">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Número de Prestación <span class="required">*</span></label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <h2><?= 'AUS-'.$pasacomision->expediente->numedis; ?></h2>
                                        </div>
                                    </div>

                                    <div class="form-group has-feedback">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Titular de la Prestación <span class="required">*</span></label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <?php
                                                
                                                echo $this->Form->input('prestacions.participante_id', [
                                                                                'type' => 'select',
                                                                                'class'=>'form-control col-md-7 col-xs-12',
                                                                                'default' => '',
                                                                                'required' => 'required',
                                                                                'label' => ['text' => ''],
                                                                                'options' => $listado_posibles_titulares_prestacion[$pasacomision->expediente->id],
                                                                                //'empty'   => array_shift($listado_posibles_titulares_prestacion)
                                                                                'empty'   => 'Selecciona un titular para esta prestación...'
                                                                            ]);
                                            ?> 
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Observaciones sobre esta Prestación </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <?php
                                                echo $this->Form->input('prestacions.observaciones', [
                                                        'class'=>'editor form-control col-md-7 col-xs-12',
                                                        //'required' => 'required',
                                                        'label' => ['text' => '']
                                                    ]);
                                            ?> 
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <?= $this->Form->button('Añadir Nueva Prestación ->', ['class' => 'btn btn-success']) ?>
                                    <?= $this->Html->link('Cerrar', ['action'=>'index'],['class' => 'btn btn-primary','data-dismiss'=>"modal"]) ?>
                                    
                                </div>
                                   
                                    <?= $this->Form->end() ?>
                            </div>

                    </div>
                </div>   


            <?php endif; ?>
        </td> 
        <td>
   
                <?php if ($atfis === 'no'): ?>

                     <?= $this->Html->link('ND', '#', [     
                                        'class'=> 'btn btn-xs modal-btn btn-danger fa sin_atfis',
                                        'id'=>$pasacomision->expediente->id,
                                        //'data-expediente' => $pasacomision->expediente->id,
                                        'data-container'=>"body",
                                        'data-toggle'=>"popover",
                                        'data-placement'=>"top",
                                        'data-content'=>"Si este expediente está DERIVADO a EDIS deberíamos tener una prestación de Apoyo Técnico y Familiar para la Inclusión Social (ATFIS). Si n o es así deberíamos crearla."]); ?>  

                    <button class="btn btn-xs btn-success modal-btn fa fa-check-square hidden" type="button" id= '<?= $modificador; ?>prestacion_atfis<?= $pasacomision->id; ?>',
                                        data-container="body",
                                        data-toggle="popover",
                                        data-placement="top",
                                        data-content="Existe una prestación de ATFIS asociada a este expediente, por lo que entendemos que está derivado para intervención desde EDIS.">   
                    </button>    
                
                <?php elseif ($atfis === 'si'): ?>
                        <button class="btn btn-xs btn-success modal-btn fa fa-check-square" type="button" id= '<?= $modificador; ?>crear_prestacion_atfis<?= $pasacomision->id; ?>',
                                        data-container="body",
                                        data-toggle="popover",
                                        data-placement="top",
                                        data-content="Existe una prestación de ATFIS asociada a este expediente, por lo que entendemos que está derivado para intervención desde EDIS.">
                        </button>      
                <?php endif; ?>


        </td>
        <td class="text-uppercase"><?= $titular; ?></td>  
        <td><?= $pasacomision->observaciones; ?></td>   
        
<!--
        <td>
            <?php if ($pasacomision->informeedis==1){echo '<span class="label label-warning">IE</span>';}
                    else{echo '<span class="label label-default">IE</span>';} ?>
                       
            <?php if ($pasacomision->diligencia==1){echo '<span class="label label-warning">D</span>';}
                    else{echo '<span class="label label-default">D</span>';} ?>

        </td>  
-->        

        <td class="<?= $ocultar;?>">

            <!--Cambiamos el color del botón si ya se han subido archivos-->
            <?php if (empty($arbol[$pasacomision['id']]['/'])): ?>
                <?php $boton_color = 'btn-danger'; 
                        $mensaje = "Adjunta el Informe y el PII adjuntos a esta comisión.";
                ?>
            <?php else: ?>
                <?php $boton_color = 'btn-success'; 
                        $mensaje = "Ya has subido archivos de este expediente, pero puedes añadir más.";
                ?>
            <?php endif; ?>

            <?= $this->Html->link('+ ', '#', [     
                            'class'=> 'btn btn-xs modal-btn '.$boton_color.' fa fa-files-o sin_prestacion',
                            'id'=>$modificador.'subir-archivos'.$pasacomision->id,
                            //'data-expediente' => $pasacomision->expediente->id,
                            'data-container'=>"body",
                            'data-toggle'=>"popover",
                            'data-placement'=>"top",
                            'data-content'=> $mensaje]); ?>  

        </td> 

        <td class="<?= $ocultar; ?>">
            
            <?= $this->Html->link('', ['controller' =>'Pasacomisions','action' => 'edit', $pasacomision->id], ['class'=> 'fa fa-edit']) ?> 
            <?= $this->Form->postLink('', ['controller' =>'Pasacomisions', 'action' => 'delete', $pasacomision->id], ['class'=> 'fa fa-trash', 'confirm' => '¿Realmente quieres eliminar este expediente de esta comisión?']); ?> 

        </td>
    
 
    </tr>      


    <!-- MODAL Añadir Informe y proyecto -->

        <div id="modal_<?= $modificador; ?>subir-archivos<?= $pasacomision->id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">

                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                            <h4 class="modal-title" id="myModalLabel">Selecciona y envía los archivos adjuntos a este paso por comisión del expediente <strong><big><?= $pasacomision->expediente->numedis; ?></big></strong></h4>
                        </div>
                        <div class="modal-body">
                           
                                       <!-- Adjuntar documentos a la comisión -->
                             <?= $this->Form->create('',['type' => 'file', 'class'=>'form-horizontal form-label-left', 'url' => ['controller' => 'Expedientes', 'action' => 'add_archivos', $pasacomision->expediente->numedis, $comision->tipo.$comision->fecha->i18nFormat('dd-MM-yyyy')]]) ?>

                                <div class="form-group has-feedback">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <?= $this->Form->input('add_files[]', ['id'=>'add_files', 'type' => 'file', 'multiple' => 'true', 'label' => 'Adjunta el Informe y el PII asociados a esta comisión:']);?>
                                    </div>
                                </div>  
                                <div class="text-center">
                                    <?= $this->Form->button('Enviar archivos ->', ['class' => 'btn btn-success  botonera-avisos']) ?>
                                </div>
                            
                            <?= $this->Form->end() ?>
                            <!-- END Adjuntar documentos a la comisión -->
                            <hr>
                                <h4>Archivos incluidos en la carpeta </h4>
                                <h2><i class="fa fa-folder"></i><strong>  AUS<?= $comision->fecha->i18nFormat('dd-MM-yyyy'); ?></strong></h2>
                                
                                <?php if (empty($arbol[$pasacomision['id']]['/'])): ?>
                                     <p>No se ha añadido ningún archivo asociado a esta comisión.</p>      
                                <?php endif; ?>

                                <?php foreach ($arbol[$pasacomision['id']]['/'] as $key => $a): ?> 

                                    <div class="row row_archivo lista_archivos">
                                        <div class="col-xs-10">
                                            <big><li class="fa fa-file"></li> <?= $a['basename'];?></big>
                                        </div>
                                        
                                        <div class="col-xs-2 text-right">
                                            
                                        </div>
                                    </div>

                                <?php endforeach; ?>


                        </div>

                    </div>

            </div>
        </div>   