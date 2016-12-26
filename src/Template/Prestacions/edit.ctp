<h1>Editar la Prestación</h1> 
<div class="row"> 
    <div class="col-md-12 col-sm-12 col-xs-12"> 
        <div class="x_panel"> 
            <div class="x_title"> 
                <h2>Modifica los datos asociados a la Prestación de <strong><?= $prestacion->prestaciontipo->tipo;?></strong> con el identificador <strong><?= $prestacion->numprestacion;?></strong> de fecha de apertura <?= $this->Time->format($prestacion->apertura, "dd/MM/yyyy", null);?>.<strong>(Expediente <?= $prestacion->expediente->numedis; ?>)</strong></h2> 

                <?= $this->Element('menus/menu_panel');?>                 
                <div class="clearfix"></div> 
            </div> 
            <div class="x_content">     
 
                <!-- Formulario --> 
                    <?= $this->Form->create($prestacion,[
                                                    'class'=>'form-horizontal form-label-left data-parsley-validate=""'
                                                    ]); ?>

                    <?php
                        echo $this->Form->input('expediente_id', [
                                'type' => 'hidden',
                                'value' => $prestacion->expediente->id,
                                'label' => ['text' => '']
                            ]);
                    ?> 

                <div class="row">
                    <div class="form-group has-feedback">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Número de Prestación <span class="required">*</span></label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <?php
                                echo $this->Form->input('numprestacion', [
                                        'class'=>'form-control col-md-7 col-xs-12',
                                        'required' => 'required',
                                        'label' => ['text' => '']
                                    ]);
                            ?> 
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group has-feedback">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tipo de Prestación <span class="required">*</span></label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <?php
                                echo $this->Form->input('prestaciontipo_id', [
                                                                'type' => 'select',
                                                                'class'=>'form-control col-md-7 col-xs-12',
                                                                'default' => '',
                                                                'required' => 'required',
                                                                'label' => ['text' => ''],
                                                                //'options' => $listado_tipos_prestacion,
                                                                //'empty'   => 'Selecciona un tipo de prestación...'
                                                            ]);
                            ?> 
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group has-feedback">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Estado de la Prestación <span class="required">*</span></label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <?php
                                echo $this->Form->input('prestacionestado_id', [
                                                                'type' => 'select',
                                                                'class'=>'form-control col-md-7 col-xs-12',
                                                                'default' => '',
                                                                'required' => 'required',
                                                                'label' => ['text' => ''],
                                                                //'options' => $listado_estados_prestacion,
                                                                //'empty'   => 'Selecciona un estado de la prestación...'
                                                            ]);
                            ?> 
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group has-feedback">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Fecha de Apertura de la Prestación <span class="required">*</span></label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <?php

                                $fecha= $this->Time->format($prestacion->apertura, "dd/MM/yyyy", null);
                                echo $this->Form->input('apertura', [
                                        'type'=>'text',
                                        //'dateFormat' => 'DDMMYYYY',
                                        'class'=>'datepicker form-control col-md-7 col-xs-12',
                                        //'required' => '',
                                        'label' => ['text' => ''],
                                        'placeholder' => '_ _ / _ _ / _ _ _ _',
                                        'value' => $fecha,
                                        //'templates'=>['dateWidget' => '{{day}}{{month}}{{year}}']
                                    ]);
                            ?> 
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group has-feedback">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Fecha de Cierre de la Prestación <span class=""></span></label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <?php
                                 
                                $fecha= $this->Time->format($prestacion->cierre, "dd/MM/yyyy", null);
                                echo $this->Form->input('cierre', [
                                        'type'=>'text',
                                        //'dateFormat' => 'DDMMYYYY',
                                        'class'=>'datepicker form-control col-md-7 col-xs-12',
                                        'required' => FALSE,
                                        'label' => ['text' => ''],
                                        'placeholder' => '_ _ / _ _ / _ _ _ _',
                                        'value' => $fecha,
                                        //'templates'=>['dateWidget' => '{{day}}{{month}}{{year}}']
                                    ]);
                            ?> 
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group has-feedback">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Titular de la Prestación <span class="required">*</span></label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <?php
                                
                                echo $this->Form->input('participante_id', [
                                                                'type' => 'select',
                                                                'class'=>'form-control col-md-7 col-xs-12',
                                                                //'default' => $participantes[$prestacion->participante_id],
                                                                'required' => 'required',
                                                                'label' => ['text' => ''],
                                                                'options' => $participantes,
                                                                //'empty'   => array_shift($participantes)
                                                            ]);
                            ?> 
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Observaciones sobre esta Prestación </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
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

                <div class="row">

                </div>

                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <?= $this->Form->button('Guardar cambios ->', ['class' => 'btn btn-success']) ?>
                        <?= $this->Html->link('Cerrar', ['controller'=>'Expedientes', 'action'=>'view', $prestacion->expediente->id],['class' => 'btn btn-primary']) ?>
                    </div>
                </div>            
               
                <?= $this->Form->end() ?>
            </div>  
                <!-- /Formulario --> 
        </div> 
    </div> 
</div>
 

