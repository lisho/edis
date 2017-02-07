

<h1><i class="fa fa-folder-open"></i>  Nuevo Expediente.</h1>


<div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    
                    <h2>Debes completar los cuatro pasos propuestos para crear correctamente un nuevo expediente en el sistema.</h2>
                    <?= $this->Element('menus/menu_panel');?>                
                    <div class="clearfix"></div>
                </div>

            <div class="x_content">
                
                <div id="wizard" class="form_wizard wizard_horizontal"> <!-- Smart Wizard -->
            
                    <ul class="wizard_steps"> <!-- Menú de Pasos - Smart Wizard -->
                        <li>
                          <a href="#step-1">
                            <span class="step_no">1</span>
                            <span class="step_descr">
                                              Paso 1<br />
                                              <small>Comprueba el sistema</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-2">
                            <span class="step_no">2</span>
                            <span class="step_descr">
                                              Paso 2<br />
                                              <small>Crea el expediente</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-3">
                            <span class="step_no">3</span>
                            <span class="step_descr">
                                              Paso 3<br />
                                              <small>Crea el Titular</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-4">
                            <span class="step_no">4</span>
                            <span class="step_descr">
                                              Paso 4<br />
                                              <small>Comprueba los datos</small>
                                          </span>
                          </a>
                        </li>
                      </ul>

        <!-- // FIN Menu de pasos-->   
                        <?= $this->Flash->render() ?>
                      <hr>

        <!-- PRIMER PASO-->                
                    <div id="step-1">

                        <?php if (!isset($comision)): ?>
                            <h2 class="StepTitle"><big><b>Primer Paso: </big></b>Antes de crear un expediente nuevo debemos comprobar que ninguna de las personas mayores de 16 años incluidas en el expediente están asociadas a otro. </h2>

                            <fieldset class="bloque-formulario">
                                <h4>Puedes comprobar la existencia de una persona en el sistema introduciendo su DNI/NIE, nombre o apellidos... Si existe, pica simplemente en él para ir al expediente. Si no aparece el resultado que buscas, pica en <b>"siguiente"</b> para continuar con el proceso de creación de un nuevo expediente.</h4>
                                <div class="form-group input-group form-group-buscador form-horizontal center-block">
                                    
                                    <input id="busca" type="text" class="form-control col-md-8 col-sm-8 col-xs-12" placeholder="Buscar a...">
                                    <span class="input-group-btn">
                                      <button class="btn btn-default " type="button"><i class="fa"></i></button>
                                    </span>
                                </div>

                            </fieldset> 
                        <?php else: ?>
                                         
                            <h2>Accedes a este formulario desde una comisión, puedes saltarte esta primera fase porque YA HABRÁS COMPROBADO A TODOS LOS MAYORES DE 16 AÑOS, ¿¿NO??: </h2>
                        <?php endif; ?>
                        

                    </div>

                        <?= $this->Form->create($expediente,[
                                            'class'=>'form-horizontal form-label-left',
                                            'role'=>'form', 'id'=>'nuevo_expediente', 
                                            'data-toggle'=>'validator', 
                                            'novalidate'
                                            ]) ?>
        
        <!-- SEGUNDO PASO--> 

                    <div id="step-2">

                        <h2 class="StepTitle"><big><b>Segundo Paso: </b></big> Si ninguna de las personas mayores de 16 años del expediente están en el sistema podemos comenzar a <u>crear el nuevo expediente:</u></h2>

                        <div class="bloque-formulario">
                            <div id="numedis_recomentdado" class="text-center">
                                <h2>Número de Expediente EDIS asignado al nuevo expediente:
                                    <div id="ver_nuevo_numedis" class="btn btn-lg btn-primary"><b><?= $proximo_numedis; ?></b></div>
                                </h2>
                            </div>
                            
                            <div id="nuevo_numedis" class="form-group hidden">
                                <span id="label_propuesta_numedis" class="label label-info"><?= $proximo_numedis; ?></span>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Número de Expediente EDIS <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        echo $this->Form->input('numedis', [
                                                'class'=>'form-control col-md-7 col-xs-12',
                                                'id' => 'numedis',
                                                'required' =>'',
                                                'label' => ['text' => ''],
                                                'value' => $proximo_numedis
                                            ]);
                                    ?> 
                                </div>
                               <!-- <div id="resultados"></div> -->
                            </div>

                            <div class="form-group has-feedback">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Número de Historia Social (SAUSS) <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        echo $this->Form->input('numhs', [
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
                                                'id' => 'domicilio',
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
                                                                        'empty'   => 'Elije un CEAS',
                                                                        'value' => 'elige un CEAS...'
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
                                                                        'empty'   => '-----'
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
                                                                        'empty'   => '-----'
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
                        </div> <!-- // FIN bloque-formulario-->
                    </div>

        <!-- TERCER PASO-->

                    <div id="step-3">
                        <h2 class="StepTitle"><big><b>Tercer Paso: </b></big>Para finalizar la creación del nuevo expediente es imprescindible introducir, al menos, los <u>datos del titular</u> del expediente...</h2>
                        
                        <div class="bloque-formulario">

 
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
                                                'required' => 'required',
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
                                <div id="sexo" class="col-md-6 col-sm-6 col-xs-12">
                                    <?php 

                                         echo $this->Form->imput(
                                                    'participantes.0.sexo',
                                                    [
                                                        'type' => 'radio',
                                                        'options'=>[
                                                            ['value' => 'M', 'text' => 'Hombre',
                                                            ],
                                                            ['value' => 'F', 'text' => 'Mujer', 
                                                            ],   
                                                        ],
                                                        'templates' => [
                                                            'radioWrapper' => '<div class="radio-inline screen-center screen-radio">{{label}}</div>'
                                                        ], 
                                                        'label' => ["class" => "radio sexo"]

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
                                                //'required' => '',
                                                'label' => ['text' => ''],
                                                'placeholder' => '_ _ / _ _ / _ _ _ _',
                                                'value'=> '',
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
                                                //'required' => '',
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
                                                //'required' => '',
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

                            <?= $this->Form->input('participantes.0.relation_id', ['type'=>'hidden', 'value'=>'1']);?>
                        
                        </div> <!-- // FIN bloque-formulario-->    
                            
                    </div>

        <!-- CUARTO PASO-->

                        <div id="step-4">
                            <h2 class="StepTitle"><big><b>Cuarto Paso: </b></big>Comprueba que los datos introducidos son correctos y completa la creación del expediente</h2>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                                    <?php if (isset($comision)): ?>
                                               
                                        <div id='paso_comision'>

                                            <?= $this->Form->input('pasacomisions.0.comision_id', [
                                                                'type'=>'hidden',
                                                                'value' => $comision->id
                                                            ]);
                                                    ?> 

                                            <?= $this->Form->input('pasacomisions.0.expediente_id', [
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

                                            <h2>Estás creando este expediente desde la comisión de <?= $comision->tipo;?> de fecha <?= $this->Time->format($comision->fecha, "dd/MM/yyyy", null);?>, por lo que <u>es necesario que completes los datos del paso por comisión</u> de este expediente para añadirlo directamente:</h2>
                                            <br>
                                            <div class="row" id="paso_motivo">
                                                <div class="form-group has-feedback">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Motivo del paso por comisión: <span class="required">*</span></label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">

                                                        <?= $this->Form->imput(
                                                                    'pasacomisions.0.motivo',
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
                                                                        'label' => ["class" => "radio"],
                                                                        'value' => 'INI'

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
                                                                    'pasacomisions.0.clasificacion',
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
                                                                        'label' => ["class" => "radio"],
                                                                        'value' => 'E'

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
                                                     <?= $this->Form->input('pasacomisions.0.diligencia', [
                                                                        'type'=>'checkbox',
                                                                    ]);
                                                            ?> 

                                                    <?= $this->Form->input('pasacomisions.0.informeedis', [
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
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Observaciones sobre el paso por comisión de este Expediente: </label>
                                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                                        <?php
                                                            echo $this->Form->input('pasacomisions.0.observaciones', [
                                                                    'class'=>'editor form-control col-md-7 col-xs-12',
                                                                    //'required' => 'required',
                                                                    'label' => ['text' => '']
                                                                ]);
                                                        ?> 
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    <?php endif; ?>

                                    <div id="datos">
                                        <br><br>
                                        <h2 ><big>Revisa los datos y completa la creación del expediente:</big></h2>
                                        <div id="datos_expediente">
                                            <h2><u>Datos del Expediente:</u></h2>
                                        
                                                <div id="div-numedis"><li class="fa fa-arrow-circle-right"></li> Número de Expediente: <span id="li-numedis">Sin datos.</span></div>
                                                <div id="div-numhs"><li class="fa fa-arrow-circle-right"></li> Número de Historia Social: <span id="li-numhs">Sin datos.</span></div>
                                                <div id="div-domicilio"><li class="fa fa-arrow-circle-right"></li> Domicilio de la unidad familiar: <span id="li-domicilio">Sin datos.</span></div>
                                                <div id="div-ceas"><li class="fa fa-arrow-circle-right"></li> CEAS de referencia: <span id="li-ceas">Sin datos.</span></div>
                                                <div id="div-tecnico_ceas"><li class="fa fa-arrow-circle-right"></li> Rol de Coordinador de Caso (CC): <span id="li-tecnico_ceas">Sin datos.</span></div>
                                                <div id="div-tecnico_inclusion"><li class="fa fa-arrow-circle-right"></li> Rol de Técnico de Inclusión (TEDIS): <span id="li-tecnico_inclusion">Sin datos.</span></div>

                                            <h2><u>Datos del Titular:</u></h2>

                                                <div id="div-participantes-0-dni"><li class="fa fa-arrow-circle-right"></li> DNI/NIE: <span id="li-participantes-0-dni" class="">Sin datos.</span></div>
                                                <div id="div-participantes-0-nombre"><li class="fa fa-arrow-circle-right"></li> Nombre: <span id="li-participantes-0-nombre" class="">Sin datos.</span></div>
                                                <div id="div-participantes-0-apellidos"><li class="fa fa-arrow-circle-right"></li> Apellidos: <span id="li-participantes-0-apellidos" class="">Sin datos.</span></div>
                                                <div id="div-sexo"><li class="fa fa-arrow-circle-right"></li> Sexo: <span id="li-sexo" class="">Sin datos.</span></div>
                                                <div id="div-participantes-0-nacimiento"><li class="fa fa-arrow-circle-right"></li> Fecha de Nacimiento: <span id="li-participantes-0-nacimiento" class="">Sin datos.</span></div>
                                                <div id="div-participantes-0-email"><li class="fa fa-arrow-circle-right"></li> Correo electrónico: <span id="li-participantes-0-email" class="">Sin datos.</span></div>
                                                <div id="div-participantes-0-telefono"><li class="fa fa-arrow-circle-right"></li> Teléfono de contacto: <span id="li-participantes-0-telefono" class="">Sin datos.</span></div>
                                                <div id="div-participantes-0-observaciones"><li class="fa fa-arrow-circle-right"></li> Observaciones sobre el Titular: <span id="li-participantes-0-observaciones" class="">Sin datos.</span></div>

                                        </div>                                       
                                    </div>
                                    <br><br>

                                    <?= $this->Form->button('CREA UN NUEVO EXPEDIENTE', ['class' => 'btn btn-success btn-lg', 'id'=>'crea_expediente' ]) ?>

                                    <? // $this->Html->link(__('Cancela'), ['action'=>'index'],['class' => 'btn btn-primary']) ?>
                                </div>
                            </div>                
                        </div>

                        <?= $this->Form->end() ?>    

                    </div> <!-- End SmartWizard Content -->                    
                </div> <!-- End x-content --> 
            </div> <!-- End x-panel --> 
        </div> <!-- End col -->
    </div> <!-- End row -->

