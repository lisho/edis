
<h1>Editar paso por Comisión</h1> 
<div class="row"> 
    <div class="col-md-12 col-sm-12 col-xs-12"> 
        <div class="x_panel"> 
            <div class="x_title"> 
                <h2>Modifica los datos asociados al paso del expediente <?= $pasacomision->expediente->numedis; ?> por la comisión de <?= $pasacomision->comision->tipo;?> de fecha <?= $this->Time->format($pasacomision->comision->fecha, "dd/MM/yyyy", null);?></h2> 
                <?= $this->Element('menus/menu_panel');?>                 
                <div class="clearfix"></div> 
            </div> 
            <div class="x_content">     
 
                <!-- Formulario --> 
                    <?= $this->Form->create($pasacomision,[
                                                    'class'=>'form-horizontal form-label-left data-parsley-validate=""'
                                                    ]); ?>

                <div class="row">

                    <div class="form-group has-feedback">
              
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Datos del expediente: <span class="required">*</span></label>
                        
                        <div id="datos_expediente" class="col-md-9 col-sm-9 col-xs-12"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group has-feedback">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Motivo del paso por comisión: <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">

                            <?= $this->Form->input('comision_id', [
                                                'type'=>'hidden',
                                                //'value' => $comision->id
                                            ]);
                                    ?> 

                            <?= $this->Form->input('pasacomision.expediente_id', [
                                                'type'=>'hidden',
                                                'id' => 'campo_expediente'
                                            ]);
                                    ?> 

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
                </div>

                <div class="row">
                    <div class="form-group">

                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Clasificación: <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        
                        <?= $this->Form->imput(
                                        'clasificacion',
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

                <div class="row">
                    <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Documentación que se adjunta: <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <?= $this->Form->input('diligencia', [
                                            'type'=>'checkbox',
                                        ]);
                                ?> 

                        <?= $this->Form->input('informeedis', [
                                            'type'=>'checkbox',
                                            'class' => '',
                                        ]);
                                ?> 
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Observaciones sobre este Expediente: </label>
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
                </div>
               
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <?= $this->Form->button('Guardar cambios ->', ['class' => 'btn btn-success']) ?>
                        <?= $this->Html->link('Cerrar', ['controller'=>'Comisions', 'action'=>'view', $pasacomision->comision->id],['class' => 'btn btn-primary']) ?>
                    </div>
                </div>           
               
                <?= $this->Form->end() ?>
            </div>  
                <!-- /Formulario --> 
        </div> 
    </div> 
</div>
 