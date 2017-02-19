<?php 
    $ocultar =''; 
    $ancho_panel_derecho ='col-md-9 col-sm-8 col-xs-12';
    $modificador ='';
    $texto_validada = "";
    $secretario = "";
    $mod = 0;
?>

<?php if ($comision->validada): ?>
     <?php  
        $ocultar="hidden";
        $ancho_panel_derecho ='col-md-12 col-sm-12 col-xs-12';
        $texto_validada = '<big class="success-text icono-titulo-fa"><strong>--- Comisión Validada ---</strong></big>';
     ?>      
<?php endif; ?>
<div class="row">
   <div class="col-lg-6 col-md-6">
        <h1><i class="fa fa-folder-open"></i>  Comisión <?= $comision->tipo; ?><small><?= ' '.$this->Time->format($comision->fecha, "dd/MM/yyyy", null); ?></small></h1>
    </div>

    <div class="col-lg-6 col-md-6 text-right">

        <?= $texto_validada;?>

        <?= $this->Html->link('', ['action' => 'index'], ['class'=> 'fa fa-backward text-primary icono-titulo-fa',
                                                                    'id'=>'volver',
                                                                    'data-container'=>"body",
                                                                    'data-toggle'=>"popover",
                                                                    'data-placement'=>"bottom",
                                                                    'data-content'=>"Vuelve al listado de comisiones."]) ?> 

         <?= $this->Html->link('', ['action' => 'edit', $comision->id], ['class'=> 'fa fa-edit text-info icono-titulo-fa '.$ocultar,
                                                                                    'id'=>'editar',
                                                                                    'data-container'=>"body",
                                                                                    'data-toggle'=>"popover",
                                                                                    'data-placement'=>"bottom",
                                                                                    'data-content'=>"Editar los datos de configuración de esta comisión."]) ?> 
        
        <?php if ($comision->tipo == "AUS"): ?>

          <?= $this->Html->link(__(''), ['action' => 'plantilla', $comision->id, '_ext' => 'pdf'], ['class'=>'text-primary icono-titulo-fa   fa fa-file-pdf-o', 'target' => '_blank',
                                                'id'=>'ver_pdf',
                                                'data-container'=>"body",
                                                'data-toggle'=>"popover",
                                                'data-placement'=>"bottom",
                                                'data-content'=>"Genera una vista previa de la plantilla total en PDF, descargable e imprimible."
            ]); ?>     

        <?php elseif ($comision->tipo == "RGC"): ?>

            <?= $this->Html->link(__(''), ['action' => 'acta', $comision->id, '_ext' => 'pdf'], ['class'=>'text-primary icono-titulo-fa   fa fa-file-pdf-o', 'target' => '_blank',
                                                'id'=>'ver_pdf',
                                                'data-container'=>"body",
                                                'data-toggle'=>"popover",
                                                'data-placement'=>"bottom",
                                                'data-content'=>"Genera una vista previa del acta en PDF, descargable e imprimible."
            ]); ?>  

        <?php endif; ?>  


        <?= $this->Html->link('', ['action' => 'validaComision', $comision->id], ['class'=>'text-primary icono-titulo-fa fa fa-thumbs-o-up '.$ocultar,
                                                                                'id'=>'valida',
                                                                                'data-container'=>"body",
                                                                                'data-toggle'=>"popover",
                                                                                'data-placement'=>"bottom",
                                                                                'data-content'=>"Valida el acta, dando por terminado el trabajo sobre ella."
            ]); ?> 

        <?= $this->Html->link('','#' , ['class'=> 'fa fa-arrows-alt text-primary icono-titulo-fa',
                                                                    'id'=>'agrandar',
                                                                    'data-container'=>"body",
                                                                    'data-toggle'=>"popover",
                                                                    'data-placement'=>"bottom",
                                                                    'data-content'=>"Maximiza el listado de los expedientes que pasan por esta comisión."]) ?> 
                                                                    
    </div> 
</div>

<!-- Barra de Progreso -->  
<?= $this->element ('herramientas/barra_progreso'); ?>

<!-- Columna Izquierda -->   
<div class="col-md-3 col-sm-4 col-xs-12 <?= $ocultar;?>" id="panel_izquierdo">

    <div class="x_panel">
        <div class="x_title">
            <h2><?= __('Buscador...') ?></h2>
             <?= $this->Element('menus/menu_panel');?>
             <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="form-group">
                <p>Busca el expediente que quieres añadir a la comisión. Puedes usar el niombre, los apellidos o el DNI/NIE de cualquier persona asociada al expediente que deseas añadir.</p>
                        <input id="busca_para_comision" type="text" class="form-control" placeholder="Buscar a..." autocomplete="off">
                </div>
      
        
                <p><u>Si no existe ningún usario del expediente en la aplicación, debes <b>crear un nuevo expediente</b></u> para añadirlos antes de incluirlos en una comisión. Puedes hacerlo desde 
                <?= $this->Html->link('', ['controller'=> 'Expedientes', 'action'=>'add', $comision->id],
                                            ['class'=>'btn btn-xs modal-btn btn-info fa fa-plus', 'target' => '_blank',
                                              'data-container'=>"body",
                                            'data-toggle'=>"popover",
                                            'data-placement'=>"right",
                                            'data-content'=>"Accede directamente a añadir un nuevo Expediente a la aplicación." 
                                            ]); ?>    
                </p>
        </div>    
    </div>

 <!-- Panel de Observaciones -->   
    <div class="x_panel">
          <div class="x_title">
            <h2><?= __('Observaciones') ?></h2>
             <?= $this->Element('menus/menu_panel');?>
            <div class="clearfix"></div>
          </div>
                
    
          <div class="x_content">
                <div class="content">

                    <?php if ($comision->observaciones===''): ?>
                        <p>No se han introducido observaciones sobre esta comisión</p>
                    <?php else: ?>
                        <?= $this->Text->autoParagraph(h($comision->observaciones)); ?>
                    <?php endif ?>

                </div>
        </div>
    </div>

 <!-- Panel de Asistentes -->   
    
    <div class="x_panel">
          <div class="x_title">
            <h2>Asistentes a esta comisión </h2>
            
            <?= $this->Element('menus/menu_panel');?>
            
            <div class="clearfix"></div>
          </div>

          <div class="x_content">

            <?php foreach ($comision->asistentecomisions as $asistente): ?>
                <div>
                    <?php if ($asistente->rol==='secretario'): ?>
                        <p><strong><i class="glyphicon glyphicon-star"></i> <?= $asistente->tecnico->nombre.' '.$asistente->tecnico->apellidos.' ('.$asistente->tecnico->equipo->nombre.') - Secr.'; ?></strong></p>
                     <?php else: ?>
                        <p><i class="glyphicon glyphicon-check"></i> <?= $asistente->tecnico->nombre.' '.$asistente->tecnico->apellidos.' ('.$asistente->tecnico->equipo->nombre.')'; ?></p>               
                    <?php endif; ?>

                    
                </div>

            <?php endforeach ?>

                <?= $this->Html->link('', '#', [     
                                    'class'=> 'btn btn-xs modal-btn btn-info fa fa-edit',
                                    'id'=>'add_asistentes',
                                    'data-container'=>"body",
                                    'data-toggle'=>"popover",
                                    'data-placement'=>"right",
                                    'data-content'=>"Añade y elimina asistentes a esta comisión."]); ?>


            <p>Selecciona al Secretario de la comisión...</p>
            <?php if(empty($secretario)){$secretario='Selecciona un TEDIS...';} ?>
            
            <?php

            
            ?>
            
            <?= $this->Form->input('secretaria',[   'id'=>'secretaria', 
                                                    'class'=>'form-control col-md-7 col-xs-12',
                                                    'type'=>'select', 
                                                    'options' => $posibles_secretarios,
                                                    'empty' => $secretario,
                                                    'label' => '',
                                                    ]); ?>


<!-- INICIO MODAL Añadir asistentes a la comision-->
                <div id="modal_add_asistentes" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Selecciona a los participantes en esta comision:</h4>
                            </div>
                            <div class="modal-body">
                                
                                 <?php foreach ($tecnicos as $tecnico): ?>
                                    <?php $checked=''; $secretario_check='';?>
                                    <?php if (isset($asistentes) && in_array($tecnico->id, $asistentes)): ?>
                                        <?php $checked='checked'; ?>
                                    <?php endif ?>
                                    <?php //if ($tecnico->rol === 'secretario' && in_array($tecnico->id, $asistentes)): ?>
                                        <?php //$secretario_check='secretario'; ?>
                                    <?php //endif ?>
                                    <div class="checkbox">
                                        <label>
                                            <input class="tecnico_check" <?= $checked;?> 
                                                    type="checkbox" 
                                                    name="<?= $tecnico->nombre.' '.$tecnico->apellidos; ?>" 
                                                    value="<?= $tecnico->id; ?>" 
                                                    placeholder=""
                                                    data-comision = "<?= $comision->id; ?>">
                                        <?= $tecnico->nombre.' '.$tecnico->apellidos.' ('.$tecnico->equipo->nombre.').'; ?>

                                        </label>
                                   </div>     
                                     
                                <?php endforeach ?>
                 
                            </div>
                            <div class="modal-footer">
                                
                                <?= $this->Html->link('Cerrar', ['#'],['id'=>'recargar_pagina', 'class' => 'btn btn-success','data-dismiss'=>"modal"]) ?>
                                
                            </div>
                        </div>
                    </div>
                </div>         

        </div> <!-- Fin Panel Asistentes a comisión-->


    </div>
<!--
<?php if ($comision->tipo == "RGC"): ?>
      <?= $this->Html->link(__('  Crear el acta'), ['action' => 'acta', $comision->id, '_ext' => 'pdf'], ['class'=>'btn btn-default fa fa-file-pdf-o', 'target' => '_blank']); ?>     
      <?= $this->Html->link('  Validar el acta', ['action' => 'valida', $comision->id], ['class'=>'btn btn-default fa fa-file-pdf-o']); ?> 
<?php endif; ?>   
-->        

</div>  <!-- // FIN columna izquierda -->   

<!-- // PANEL DERECHO - Expedientes por CEAS --> 

<div class="<?= $ancho_panel_derecho;?>" id="panel_derecho">   

    <div class="x_panel">
        <div class="x_title">
            <big>Expedientes que han pasado por esta comisión <b class="azul"><?= count($comision->pasacomisions);?></b></big>
            
            <?= $this->Element('menus/menu_panel');?>
           
            <div class="clearfix"></div>
        </div>

        <div class="x_content">      

            <div class="col-xs-10">
              <!-- Tab panes -->
              <div class="tab-content">
                
                <div class="tab-pane active" id="todos-r"> 
                    <?php if (isset($expedientes_ordenados)): ?>

                        <?php foreach ($expedientes_ordenados as $key => $ceas): ?>

                <!-- TABLA COMPLETA-->
                            <h3><?= $listado_ceas[$key]; ?></h3>
                                <table class="table">
                                    <thead>
                                        <tr>

                                            <!-- MOTIVO -->
                                            <th>Mot.</th>
                                            <!-- CLASIFICACION : Solo RGC -->
                                            <?php if ($comision->tipo=="RGC"): ?>
                                                <th>Clas.</th>       
                                            <?php endif; ?>
                                            <!-- EXPEDIENTE EDIS -->
                                            <th>Exp.</th>
                                            <!-- HISTORIA SOCIAL -->
                                            <th>HS</th>

                                            <!-- Numero de PRESTACIÓN -->
                                            <?php if ($comision->tipo=="RGC"): ?>
                                                <th>Pres. RGC</th>
                                            <?php elseif ($comision->tipo=="AUS"): ?>                                                       
                                                 <th>Pres. AUS</th>
                                            <?php endif; ?>

                                            <!-- TITULAR Prestacion -->
                                            <th>Titular Pres.</th>
                                             <!-- DERIVADO -->
                                            <th>Deriv</th>
                                            <!-- DOCUMENTACION : Solo RGC -->
                                            <?php if ($comision->tipo=="RGC"): ?>
                                                <th>Docum.</th>       
                                            <?php endif; ?>
                                            <!-- AJUSTE -->
                                            <th class="<?= $ocultar;?>"></th>
                                                                                    
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($ceas as $pasacomision): ?>

                                            <?php $mod++; ?>
                                            <?php if ($comision['tipo'] == "RGC"): ?>

                                                <?= $this->element ('comisiones/tablas_pasos_por_comision', [   
                                                                                    'pasacomision' => $pasacomision,
                                                                                    'listado_posibles_titulares_prestacion' => $listado_posibles_titulares_prestacion,
                                                                                    'modificador' => 'ceas_',
                                                                                    'ocultar' => $ocultar,
                                                                                    'arbol' => $arbol,
                                                                                    'mod' => $mod
                                                                                ])?>

                                            <?php elseif ($comision['tipo'] == "AUS"): ?>
                                                 
                                                <?= $this->element ('comisiones/tablas_pasos_por_comision_aus', [   
                                                                                    'pasacomision' => $pasacomision,
                                                                                    'listado_posibles_titulares_prestacion' => $listado_posibles_titulares_prestacion,
                                                                                    'modificador' => 'ceas_',
                                                                                    'ocultar' => $ocultar,
                                                                                    'arbol' => $arbol,
                                                                                    'mod' => $mod
                                                                                ])?>

                                            <?php endif ?>

                                        <?php endforeach ?>

                                    </tbody>
                                </table>

                        <?php endforeach ?>
                 
                    <?php else: ?>
                        <h3>Aún no has añadido ningún expediente a esta comisión...</h3>
                    <?php endif; ?>    

                </div>

                <?php foreach ($listado_ceas as $key => $ceas): ?>
                    <div class="tab-pane" id="<?= $key; ?>-r">
                     
                 <!-- TABLA POR CEAS-->                       
                            <h3><?= $ceas; ?></h3>
                             <table class="table">
                                    <thead>
                                        <tr>
                                           
                                            <!-- MOTIVO -->
                                            <th>Mot.</th>
                                            <!-- CLASIFICACION : Solo RGC -->
                                            <?php if ($comision->tipo=="RGC"): ?>
                                                <th>Clas.</th>       
                                            <?php endif; ?>
                                            <!-- EXPEDIENTE EDIS -->
                                            <th>Exp.</th>
                                            <!-- HISTORIA SOCIAL -->
                                            <th>HS</th>

                                            <!-- Numero de PRESTACIÓN -->
                                            <?php if ($comision->tipo=="RGC"): ?>
                                                <th>Pres. RGC</th>
                                            <?php elseif ($comision->tipo=="AUS"): ?>                                                       
                                                 <th>Pres. AUS</th>
                                            <?php endif; ?>

                                            <!-- TITULAR Prestacion -->
                                            <th>Titular Pres.</th>
                                             <!-- DERIVADO -->
                                            <th>Deriv</th>
                                            <!-- DOCUMENTACION : Solo RGC -->
                                            <?php if ($comision->tipo=="RGC"): ?>
                                                <th>Docum.</th>       
                                            <?php endif; ?>
                                            <!-- AJUSTE -->
                                            <th class="<?= $ocultar;?>"></th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php foreach ($comision->pasacomisions as $pasacomision): ?>

                                            <?php $mod++; ?>
                                            <?php if ($pasacomision->expediente->ceas==$key && $comision['tipo'] == "RGC"): ?>

                                                <?= $this->element ('comisiones/tablas_pasos_por_comision', [   
                                                                                    'pasacomision' => $pasacomision,
                                                                                    'listado_posibles_titulares_prestacion' => $listado_posibles_titulares_prestacion,
                                                                                    'modificador' => 'ceas_',
                                                                                    'ocultar' => $ocultar,
                                                                                    'arbol' => $arbol,
                                                                                    'mod' => $mod

                                                                                ])?>

                                            <?php elseif ($pasacomision->expediente->ceas==$key && $comision['tipo'] == "AUS"): ?>
                                                 
                                                <?= $this->element ('comisiones/tablas_pasos_por_comision_aus', [   
                                                                                    'pasacomision' => $pasacomision,
                                                                                    'listado_posibles_titulares_prestacion' => $listado_posibles_titulares_prestacion,
                                                                                    'modificador' => 'ceas_',
                                                                                    'ocultar' => $ocultar,
                                                                                    'arbol' => $arbol,
                                                                                    'mod' => $mod

                                                                                ])?>

                                            <?php endif ?>

                                        <?php endforeach ?>

                                    </tbody>
                                </table>                        
                    </div>
                <?php endforeach ?>
                    
              </div>
            
            </div>

            <div class="col-xs-2">
              <!-- required for floating -->
              <!-- Nav tabs -->

              <ul class="nav nav-tabs tabs-right">
                    <li><a href="#todos-r" data-toggle="tab" aria-expanded="true">Visión Global</a>
                <?php foreach ($listado_ceas as $key => $ceas): ?>
                    <li class="lista_ceas_comision"><a href="#<?= $key; ?>-r" data-toggle="tab" ><?= $ceas; ?></a>
                <?php endforeach ?>    
              </ul>

            </div>

        </div>
    </div>
</div>


<!-- MODAL Nuevo Pasacomision-->

<div id="modal_add_pasacomision" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Añade un nuevo expediente a esta comisión...</h4>
            </div>
            <div class="modal-body">

                    <?= $this->Form->create($nuevo_pasacomision,[
                                                    'class'=>'form-horizontal form-label-left data-parsley-validate=""'
                                                    ]); ?>

                <div class="row">

                    <div class="form-group has-feedback">
              
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Datos del expediente: <span class="required">*</span></label>
                        
                        <div id="datos_expediente" class="col-md-9 col-sm-9 col-xs-12"></div>
                    </div>
                </div>

              
                            <?= $this->Form->input('pasacomision.comision_id', [
                                                'type'=>'hidden',
                                                'value' => $comision->id
                                            ]);
                                    ?> 

                            <?= $this->Form->input('pasacomision.expediente_id', [
                                                'type'=>'hidden',
                                                'id' => 'campo_expediente'
                                            ]);
                                    ?> 


        <?php if ($comision->tipo=='AUS'): ?> <!-- Sólo en caso de ser una comision de AUS pasamos la variable para mi_js.js-->

            <script>
                var tipo_comision = "aus";
            </script>

        <?php elseif ($comision->tipo=='RGC'): ?>
            <script>
                var tipo_comision = "rgc";
            </script>
        <?php endif; ?>

                <div class="row" id="paso_motivo">
                    <div class="form-group has-feedback">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Motivo del paso por comisión: <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">

                            <?= $this->Form->imput(
                                        'pasacomision.motivo',
                                        [
                                            'type' => 'radio',
                                            'options'=>[
                                                ['value' => 'INI', 'text' => 'Inicial (INI)',
                                                ],
                                                ['value' => 'RIP', 'text' => 'Revisión a Instancia de Parte (RIP)', 
                                                ],
                                                ['value' => 'ROF', 'text' => 'Revisión de Oficio (ROF)',
                                                ],     
                                            ],
                                            'templates' => [
                                                'radioWrapper' => '<div class="radio-inline screen-center screen-radio">{{label}}</div>'
                                            ], 
                                            'label' => ["class" => "radio"]

                                        ]

                                    );
                                ?> 
                      
                        </div>
                    </div>
                </div>
                                 
                <div class="row" id="paso_clasificacion">
                    <div class="form-group">

                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Clasificación: <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        
                        <?= $this->Form->imput(
                                        'pasacomision.clasificacion',
                                        [
                                            'type' => 'radio',
                                            'options'=>[
                                                ['value' => 'E', 'text' => 'Estructural',
                                                ],
                                                ['value' => 'C', 'text' => 'Coyuntural', 
                                                ],
                                            ],
                                            'templates' => [
                                                'radioWrapper' => '<div class="radio-inline screen-center screen-radio">{{label}}</div>'
                                            ], 
                                            'label' => ["class" => "radio"]

                                        ]

                                    );
                            ?> 
                        </div>
                    </div>
                </div>

                <div class="row" id="paso_documentacion">
                    <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Documentación que se adjunta: <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <?= $this->Form->input('pasacomision.diligencia', [
                                            'type'=>'checkbox',
                                        ]);
                                ?> 

                        <?= $this->Form->input('pasacomision.informeedis', [
                                            'type'=>'checkbox',
                                            'class' => '',
                                            'label' => 'Informe de Seguimiento de EDIS'
                                        ]);
                                ?> 
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Observaciones sobre este Expediente: </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <?php
                                echo $this->Form->input('pasacomision.observaciones', [
                                        'class'=>'editor form-control col-md-7 col-xs-12',
                                        //'required' => 'required',
                                        'label' => ['text' => '']
                                    ]);
                            ?> 
                        </div>
                    </div>
                </div>
               
            </div>
            <div class="modal-footer">
                <?= $this->Form->button('Guardar cambios ->', ['class' => 'btn btn-success']) ?>
                <?= $this->Html->link('Cerrar', ['action'=>'index'],['class' => 'btn btn-primary','data-dismiss'=>"modal"]) ?>
                
            </div>
               
                <?= $this->Form->end() ?>
        </div>
    </div>
</div>



<!-- Pasamos el valor de la variable comision id para el ajax-->
<script type="text/javascript">
var comision_id = '<?php echo $comision['id']; ?>';
</script>

<!-- Pasamos el valor de la variable antiguo_secretario para el ajax-->
<?php if (!empty($secretario)): ?>
    <script>
        var antiguo_secretario = "";
        var antiguo_secretario = '<?php echo key($secretario); ?>';
    </script>       
<?php endif; ?>