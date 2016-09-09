

<h1>Nuevo Técnico.</h1>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Añade un nuevo Técnico al sistema...</h2>
                <?= $this->Element('menus/menu_panel');?>                
                <div class="clearfix"></div>
            </div>
            <div class="x_content">    

                <!-- Formulario -->

                <?= $this->Form->create($tecnico,['class'=>'form-horizontal form-label-left data-parsley-validate=""']) ?>
                

                <fieldset>
                                        
                    <div class="form-group has-feedback">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php
                                echo $this->Form->input('nombre', [
                                        'class'=>'form-control col-md-7 col-xs-12',
                                        'required' =>'required',
                                        'label' => ['text' => '']
                                    ]);
                            ?> 
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Apellidos <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php
                                echo $this->Form->input('apellidos', [
                                        'class'=>'form-control col-md-7 col-xs-12',
                                        //'required' => 'required',
                                        'label' => ['text' => '']
                                    ]);
                            ?> 
                        </div>
                    </div>

                    <div class="form-group has-feedback">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Equipo <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php
                            
                                echo $this->Form->select('equipo_id', $equipos, [
                                        'class'=>'form-control col-md-7 col-xs-12',
                                        'empty' => 'Selecciona un equipo',
                                        'required' => 'required',
                                        'label' => ['text' => '']
                                    ]);

                            ?> 
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Puestos <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php


                                $puestos = [    'Trabajador/a Social' => 'Trabajador/a Social',
                                                'Psicólogo/a' => 'Psicólogo/a',
                                                'Asesora Juridica' => 'Asesora Juridica',
                                                'Tecnico/a Inmigración' => 'Tecnico/a Inmigración' ]; // Cambiar tambien en edit

                                echo $this->Form->select('puesto', $puestos, [
                                        'empty' => 'Selecciona el puesto que ocupa',
                                        'class'=>'form-control col-md-7 col-xs-12',
                                        //'required' => 'required',
                                        'label' => ['text' => '']
                                    ]);

                            ?> 
                        </div>
                    </div>
<!--           
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Importancia <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php 

                                 echo $this->Form->imput(
                                            'puesto',
                                            [
                                                'type' => 'radio',
                                                'options'=>[
                                                    ['value' => 'alta', 'text' => 'Alta', 'style' => 'color:red;',
                                                    ],
                                                    ['value' => 'media', 'text' => 'Media', 'style' => 'color:yellow;',
                                                    ],
                                                    ['value' => 'baja', 'text' => 'Baja', 'style' => 'background-color:green;'],       
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


                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Caduca <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php

                                echo $this->Form->input('caduca', [
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
     
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Caduca <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php

                                echo $this->Form->input('caduca', [
                                        'type'=>'date',
                                        //'dateFormat' => 'DMY',
                                        'class'=>'form-control col-md-7 col-xs-12',
                                        //'required' => 'required',
                                        'label' => ['text' => ''],
                                        'templates'=>['dateWidget' => '{{day}}{{month}}{{year}}']
                                    ]);
                            ?> 
                        </div>
                    </div>
 -->               
                    <?= $this->Form->hidden('user_id', ['value' => $auth['id']] );?>    
                </fieldset>                

                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success']) ?>
                <?= $this->Html->link(__('Cancel'), ['action'=>'index'],['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
               
                <?= $this->Form->end() ?>
                <!-- /Formulario -->
            </div>
        </div>
    </div>
</div>