
<h1>Añadir Nuevo Rol para el expediente .</h1>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            
            <div class="x_title">
                <h2>Crea un nuevo expediente en el sistema...</h2>
                <?= $this->Element('menus/menu_panel');?>                
                <div class="clearfix"></div>
            </div>
            <div class="x_content">    

                <!-- Formulario -->

                <?= $this->Form->create($expediente,['class'=>'form-horizontal form-label-left data-parsley-validate=""']) ?>

    <fieldset>

        <br>
        <h4>Si no has obtenido ningún resultado en el buscador anterior, puedes iniciar la <strong>creación de un nuevo expediente</strong>: </h4> <hr>
        
        <div class="form-group has-feedback">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Número de Expediente EDIS <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?php
                    echo $this->Form->input('numedis', [
                            'class'=>'form-control col-md-7 col-xs-12',
                            'required' =>'required',
                            'label' => ['text' => '']
                        ]);
                ?> 
            </div>
        </div>

        <div class="form-group has-feedback">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Número de Expediente RGC <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?php
                    echo $this->Form->input('numrgc', [
                            'class'=>'form-control col-md-7 col-xs-12',
                            'required' =>'required',
                            'label' => ['text' => '']
                        ]);
                ?> 
            </div>
        </div>

        <div class="form-group has-feedback">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Domicilio <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?php
                    echo $this->Form->input('domicilio', [
                            'class'=>'form-control col-md-7 col-xs-12',
                            'required' =>'required',
                            'label' => ['text' => '']
                        ]);
                ?> 
            </div>
        </div>

        <div class="form-group has-feedback">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">CEAS de Referencia <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?php
                    echo $this->Form->input('ceas', [
                                                    'type' => 'select',
                                                    'class'=>'form-control col-md-7 col-xs-12',
                                                    'default' => '',
                                                    'id'=> 'ceas',
                                                    'required' => 'required',
                                                    'label' => ['text' => ''],
                                                    'options' => $listado_ceas,
                                                    'empty'   => 'Elije un Ceas'
                                                ]);
                ?> 
            </div>
        </div>

        <div class="form-group has-feedback">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Coordinador de Caso (CC) <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?php
                    echo $this->Form->input('tecnico_ceas', [
                                                    'type' => 'select',
                                                    'class'=>'form-control col-md-7 col-xs-12',
                                                    'id' => 'tecnico_ceas',
                                                    'default' => '',
                                                    'required' => 'required',
                                                    'label' => ['text' => ''],
                                                    //'options' => $tecnicoList,
                                                    'empty'   => 'Elije un Coordinador de Caso'
                                                ]);
                ?> 
            </div>
        </div>

        <div class="form-group has-feedback">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Técnico de Inclusión (TEDIS) <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?php
                    echo $this->Form->input('tecnico_inclusion', [
                                                    'type' => 'select',
                                                    'class'=>'form-control col-md-7 col-xs-12',
                                                    'id' => 'tecnico_inclusion',
                                                    'default' => '',
                                                    'required' => 'required',
                                                    'label' => ['text' => ''],
                                                    'empty'   => 'Elije un Técnico de Inclusión'
                                                ]);
                ?> 
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Observaciones sobre este EXPEDIENTE <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?php
                    echo $this->Form->input('observaciones', [
                            'class'=>'editor form-control col-md-7 col-xs-12',
                            //'required' => 'required',
                            'label' => ['text' => '']
                        ]);
                ?> 
            </div>
        </div>

        <!-- 
        ********************** Formulario Nuevo Usuario *************************** -->
        <br><br>
        <h4>Para completar la creación de un nuevo expediente necesitamos crear también, al menos, la ficha de un <strong>usuario adscrito al expediente</strong>: </h4> <hr>

        <?php
            echo $this->Form->input('participantes.0.id', [
                    'class'=>'',
                    'required' => 'required',
                    'label' => ['text' => ''],
                ]);
        ?> 

        <div class="form-group has-feedback">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">DNI/NIE <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?php
                    echo $this->Form->input('participantes.0.dni', [
                            'class'=>'form-control col-md-7 col-xs-12',
                            'required' => 'required',
                            'label' => ['text' => '']
                        ]);
                ?> 
            </div>
        </div>

        <div class="form-group has-feedback">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?php
                    echo $this->Form->input('participantes.0.nombre', [
                            'class'=>'form-control col-md-7 col-xs-12',
                            //'required' => 'required',
                            'label' => ['text' => '']
                        ]);
                ?> 
            </div>
        </div>

        <div class="form-group has-feedback">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Apellidos <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?php
                    echo $this->Form->input('participantes.0.apellidos', [
                            'class'=>'form-control col-md-7 col-xs-12',
                            'required' => 'required',
                            'label' => ['text' => '']
                        ]);
                ?> 
            </div>
        </div>

        <div class="form-group has-feedback">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Sexo <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?php 

                     echo $this->Form->imput(
                                'participantes.0.sexo',
                                [
                                    'type' => 'radio',
                                    'options'=>[
                                        ['value' => 'M', 'text' => 'Hombre', 'style' => 'color:red;',
                                        ],
                                        ['value' => 'F', 'text' => 'Mujer', 'style' => 'color:yellow;',
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

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha de Nacimiento <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?php

                    echo $this->Form->input('participantes.0.nacimiento', [
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

        <div class="form-group has-feedback">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Correo Electrónico <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?php
                    echo $this->Form->input('participantes.0.email', [
                            'class'=>'form-control col-md-7 col-xs-12',
                            'required' => 'required',
                            'label' => ['text' => '']
                        ]);
                ?> 
            </div>
        </div>

        <div class="form-group has-feedback">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Teléfono <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?php
                    echo $this->Form->input('participantes.0.telefono', [
                            'class'=>'form-control col-md-7 col-xs-12',
                            //'required' => 'required',
                            'label' => ['text' => '']
                        ]);
                ?> 
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Observaciones sobre este USUARIO <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?php
                    echo $this->Form->input('participantes.0.observaciones', [
                            'class'=>'editor form-control col-md-7 col-xs-12',
                            //'required' => 'required',
                            'label' => ['text' => '']
                        ]);
                ?> 
            </div>
        </div>


        
        <?php
            /*
            echo $this->Form->input('ceas', [
                                                    'type' => 'select',
                                                    'class'=>'form-control col-md-7 col-xs-12',
                                                    'default' => '',
                                                    'required' => 'required',
                                                    'label' => ['text' => ''],
                                                    'options' => $listado_ceas,
                                                ]);
            
            echo $this->Form->input('role.0.tecnico.id', [
                                                    'type' => 'select',
                                                    'class'=>'form-control col-md-7 col-xs-12',
                                                    'default' => '',
                                                    'required' => 'required',
                                                    'label' => ['text' => ''],
                                                    'multiple' => true,
                                                    //'options' => $tecnicoList,
                                                ]);

            //echo $this->Form->input('Roles.tecnico_id', ['type'=>'select', ]);
            echo $this->Form->input('Roles.rol');
            echo $this->Form->input('Roles.observaciones');
            */
        ?>
    </fieldset>

    <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <?= $this->Form->button('Crear el expediente y añadir usuarios ->', ['class' => 'btn btn-success']) ?>
                <?= $this->Html->link(__('Cancel'), ['action'=>'index'],['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
               
    <?= $this->Form->end() ?>
</div>