<?php $expediente = $informe->expediente?>
<h1>Borrador de Informe <small>creado por <?= $informe->user->nombre." ".$informe->user->apellidos; ?></small></h1> 
<div class="row"> 
    <div class="col-md-12 col-sm-12 col-xs-12"> 
        <div class="x_panel"> 
            <div class="x_title"> 
                <h2>Completa el informe para el expediente <strong><big><?= $expediente->numedis; ?></big></strong> antes de validarlo.
                    
                          <?= $this->Html->link(__('  Vista previa del informe'), ['action' => 'informe', $informe->id, '_ext' => 'pdf'], ['class'=>'btn btn-default fa fa-file-pdf-o', 'target' => '_blank', 'id'=>'ver_informe',
                                                'data-container'=>"body",
                                                'data-toggle'=>"popover",
                                                'data-placement'=>"top",
                                                'data-content'=>"Genera una vista preliminar del informe en PDF."]); ?>

                          <?= $this->Html->link('  Validar el informe', ['action' => 'valida', $informe->id], ['class'=>'btn btn-default fa fa-file-pdf-o',  'id'=>'valida_informe',
                                                'data-container'=>"body",
                                                'data-toggle'=>"popover",
                                                'data-placement'=>"top",
                                                'data-content'=>"Valida y guarda una copia del informe en PDF en la carpeta de documentos de este expediente."]); ?> 
         
                </h2> 
                <?= $this->Element('menus/menu_panel');?>                 
                <div class="clearfix"></div> 
            </div> 
            <div class="x_content">     
 
                <!-- Formulario --> 
 
                <?= $this->Form->create($informe,['class'=>'form-horizontal form-label-left']) ?> 

                    <?php 
                        echo $this->Form->hidden('user_id', [ 
                                'value' => $auth['id']
                            ]); 

                        echo $this->Form->hidden('expediente_id', [ 
                                'value' => $expediente->id
                            ]); 

                        echo $this->Form->hidden('estado', [ 
                                'value' => 'borrador'
                            ]); 
                    ?>  
                 
                
                <fieldset> 

                    <div class="form-group"> 
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tipo de Informe <span class="required">*</span></label> 
                        <div class="col-md-6 col-sm-6 col-xs-12"> 
                        <?php 
                            echo $this->Form->select('tipo', ['seguimiento'=>'Informe de Seguimiento', 'cierre'=> 'Informe de Cierre'], [ 
                                        'class'=>'form-control col-md-7 col-xs-12', 
                                        'required' => 'required', 
                                        'label' => ['text' => ''], 
                                        'default' => 'continuar' 
                                    ]); 
                        ?>  
                        </div> 
                    </div> 

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha de firma del informe <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php

                                $fecha= $this->Time->format($informe->fecha, "dd/MM/yyyy", null);

                                echo $this->Form->input('fecha', [
                                        'type'=>'text',
                                        //'dateFormat' => 'DMY',
                                        'class'=>'datepicker form-control col-md-7 col-xs-12',
                                        //'required' => '',
                                        'label' => ['text' => ''],
                                        'placeholder' => '_ _ / _ _ / _ _ _ _',
                                        'value'=> '',
                                        //'templates'=>['dateWidget' => '{{day}}{{month}}{{year}}'],
                                        'value' => $fecha,
                                    ]);
                            ?> 
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Antecedentes <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php
                                echo $this->Form->input('antecedentes', [
                                        'class'=>'editor form-control col-md-7 col-xs-12',
                                        //'required' => 'required',
                                        'label' => ['text' => '']
                                    ]);
                            ?> 
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Situación <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php
                                echo $this->Form->input('situacion', [
                                        'class'=>'editor form-control col-md-7 col-xs-12',
                                        //'required' => 'required',
                                        'label' => ['text' => '']
                                    ]);
                            ?> 
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Proyecto Individualizado de Inserción <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php
                                echo $this->Form->input('pii', [
                                        'class'=>'editor form-control col-md-7 col-xs-12',
                                        //'required' => 'required',
                                        'label' => ['text' => '']
                                    ]);
                            ?> 
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Valoración <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php
                                echo $this->Form->input('valoracion', [
                                        'class'=>'editor form-control col-md-7 col-xs-12',
                                        //'required' => 'required',
                                        'label' => ['text' => '']
                                    ]);
                            ?> 
                        </div>
                    </div>
 
                    <div class="form-group"> 
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Propuesta de intervención <span class="required">*</span></label> 
                        <div class="col-md-6 col-sm-6 col-xs-12"> 
                        <?php 
                            echo $this->Form->select('propuesta', ['continuar'=>'Continuar con la intervención desde EDIS', 'cerrar'=> 'Cerrar la Intervención desde EDIS'], [ 
                                        'class'=>'form-control col-md-7 col-xs-12', 
                                        'required' => 'required', 
                                        'label' => ['text' => ''], 
                                        'default' => 'continuar' 
                                    ]); 
                        ?>  
                        </div> 
                    </div> 
 
                </fieldset> 
 
                <div class="ln_solid"></div> 
                <div class="form-group"> 
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"> 
                <?= $this->Form->button(__('Guardar cambios'), ['class' => 'btn btn-success']) ?> 
                <?= $this->Html->link(__('Cancelar'), ['action'=>'index',$expediente->id],['class' => 'btn btn-primary']) ?> 
                    </div> 
                </div> 
                
                <?= $this->Form->end() ?> 
                <!-- /Formulario --> 
            </div> 
        </div> 
    </div> 
</div>
