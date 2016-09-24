<h1><i class="fa fa-folder-open"></i>  Comisión <?= $comision->tipo; ?><small><?= ' '.$this->Time->format($comision->fecha, "dd/MM/yyyy", null); ?></small></h1>

<!-- Columna Izquierda -->   
<div class="col-md-3 col-sm-4 col-xs-12">
 
 <!-- Panel de Observaciones -->   
    <div class="x_panel">
          <div class="x_title">
            <h2><?= __('Observaciones') ?></h2>
            
            <div class="clearfix"></div>
          </div>
                <div class="content">

                    <?php if ($comision->observaciones===''): ?>
                        <p>No se han introducido observaciones sobre esta comisión</p>
                    <?php else: ?>
                        <?= $this->Text->autoParagraph(h($comision->observaciones)); ?>
                    <?php endif ?>

                </div>
    
          <div class="x_content">

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
                    <p><i class="glyphicon glyphicon-check"></i> <?= $asistente->tecnico->nombre.' '.$asistente->tecnico->apellidos.' ('.$asistente->tecnico->equipo->nombre.')'; ?></p>
                </div>

            <?php endforeach ?>

                <?= $this->Html->link('', '#', [     
                                    'class'=> 'btn btn-xs modal-btn btn-info fa fa-edit',
                                    'id'=>'add_asistentes',
                                    'data-container'=>"body",
                                    'data-toggle'=>"popover",
                                    'data-placement'=>"right",
                                    'data-content'=>"Añade y elimina asistentes a esta comisión."]); ?>

                <div id="modal_add_asistentes" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Selecciona a los participantes en esta comision:</h4>
                            </div>
                            <div class="modal-body">
                                
                                 <?php foreach ($tecnicos as $tecnico): ?>
                                    <?php $checked=''; ?>
                                    <?php if (isset($asistentes) && in_array($tecnico->id, $asistentes)): ?>
                                        <?php $checked='checked'; ?>
                                    <?php endif ?>
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

        </div>
    </div>

     <fieldset class="">
        <div class="input-group">
            <input id="busca_para_comision" type="text" class="form-control" placeholder="Buscar a..." autocomplete="off">
            <span class="input-group-btn">
              <button class="btn btn-default modal-btn" id="add_pasacomision" type="button"><i class="fa fa-plus"></i></button>
            </span>
        </div>

        <p>Busca el expediente que quieres añadir a la comisión. Puedes usar el niombre, los apellidos o el DNI/NIE de cualquier persona asociada al expediente que deseas añadir.</p>
        
       
    </fieldset>

</div>  <!-- // FIN columna izquierda -->   

<!-- // PANEL DERECHO - Expedientes por CEAS --> 

<div class="col-md-9 col-sm-8 col-xs-12">

    <div class="x_panel">
        <div class="x_title">
            <big>Expedientes que han pasado por esta comisión </big>

        <!--     <?= $this->Html->link('', '#', [     
                                    'class'=> 'btn btn-xs modal-btn btn-info fa fa-plus',
                                    'id'=>'add_pasacomisión',
                                    'data-container'=>"body",
                                    'data-toggle'=>"popover",
                                    'data-placement'=>"right",
                                    'data-content'=>"Añade un nuevo expediente a esta comisión..."]) ?> -->

            <?= $this->Element('menus/menu_panel');?>
           
            <div class="clearfix"></div>
        </div>

        <div class="x_content">      

            <div class="col-xs-9">
              <!-- Tab panes -->
              <div class="tab-content">
                
                <?php foreach ($listado_ceas as $key => $ceas): ?>
                    <div class="tab-pane" id="<?= $key; ?>-r">
                     
                        <?php if (!empty($comision->pasacomisions)): ?>

                             <table>
                                    <thead>
                                        <tr>
                                            <th>Motivo</th>
                                            <th>Clasif.</th>
                                            <th>Numedis</th>
                                            <th>Numhas</th>
                                            <th>Titular</th>
                                            <th>Observ.</th>
                                            <th>>Docum.</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php foreach ($comision->pasacomisions as $pasacomision): ?>
                               
                                            <?php if ($pasacomision->expediente->ceas===$key): ?>
                                                <tr>
                                                    <td>data</td>
                                                    <td></td>   
                                                    <td></td>   
                                                    <td></td>   
                                                    <td></td>   
                                                    <td></td>   
                                                    <td></td>   
                                                </tr>
                                            <?php endif ?>
                                        <?php endforeach ?>

                                    </tbody>
                                </table>
                            
                        <?php else: ?>
                            No hay expedientes del <?= $ceas; ?> para esta Comisión...
                        <?php endif ?>   
                        
                    </div>
                <?php endforeach ?>
                    
              </div>
            
            </div>

            <div class="col-xs-3">
              <!-- required for floating -->
              <!-- Nav tabs -->
              <ul class="nav nav-tabs tabs-right">
                
                <?php foreach ($listado_ceas as $key => $ceas): ?>
                    <li><a href="#<?= $key; ?>-r" data-toggle="tab"><?= $ceas; ?></a>
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

                <?= $this->Form->create($pasacomision,[
                                            'url' => ['controller' => 'Pasacomisions', 'action' => 'add'], 
                                            'class'=>'form-horizontal form-label-left data-parsley-validate=""'
                                            ]); ?>


                <?= $this->Form->input('comision_id', [
                                    'type'=>'hidden',
                                    'value' => $comision->id
                                ]);
                        ?> 

                <?= $this->Form->input('expediente_id', [
                                    'type'=>'text',
                                    'id' => 'campo_expediente'
                                ]);
                        ?> 

                <div id='datos_expediente'>
                    
                </div>
                    <div class="form-group has-feedback">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Motivo del paso por comisión: <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?= $this->Form->imput(
                                        'motivo',
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

                 <?= $this->Form->input('diligencia', [
                                    'type'=>'check-box',
                                    //'options' => ['INI', 'RIP', 'ROF'],
                                ]);
                        ?> 

                <?= $this->Form->input('informeedis', [
                                    'type'=>'check-box',
                                    'class' => '',
                                    //'options' => ['INI', 'RIP', 'ROF'],
                                ]);
                        ?> 


                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha de Nacimiento <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php

                            echo $this->Form->input('nacimiento', [
                                    'type'=>'text',
                                    //'dateFormat' => 'DMY',
                                    'class'=>'datepicker form-control col-md-7 col-xs-12',
                                    //'required' => 'required',
                                    'label' => ['text' => ''],
                                    'placeholder' => '_ _ / _ _ / _ _ _ _'
                                    //'templates'=>['dateWidget' => '{{day}}{{month}}{{year}}']
                                ]);
                        ?> 
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
var comision_id = '<?php echo $comision['id'] ?>';
</script>