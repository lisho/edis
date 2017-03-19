<h1><i class="fa fa-newspaper-o"></i>  Editar Aviso / Noticia.</h1>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Crea un nuevo aviso o noticia que podrán ver todos los usuarios del sistema...</h2>
                <?= $this->Element('menus/menu_panel');?>                
                <div class="clearfix"></div>
            </div>
            <div class="x_content">    

                <!-- Formulario -->

                <?= $this->Form->create($aviso,['class'=>'form-horizontal form-label-left data-parsley-validate=""']) ?>
                

                <fieldset>
                                        
                    <div class="form-group has-feedback">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Título <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php
                                echo $this->Form->input('titulo', [
                                        'class'=>'form-control col-md-7 col-xs-12',
                                        'required' =>'required',
                                        'label' => ['text' => '']
                                    ]);
                            ?> 
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripción <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php
                                echo $this->Form->input('description', [
                                        'class'=>'editor form-control col-md-7 col-xs-12',
                                        //'required' => 'required',
                                        'label' => ['text' => '']
                                    ]);
                            ?> 
                        </div>
                    </div>

                    <div class="form-group has-feedback">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php
                            
                                if ($auth['role']==='admin'){
                                    $tipos = ['noticia'=>'Noticia', 'aviso'=>'Aviso', 'novedades'=>'Novedades'];
                                } else {
                                    $tipos = ['noticia'=>'Noticia', 'aviso'=>'Aviso'];
                                }
                               
                                echo $this->Form->select('tipo', $tipos, [
                                        'class'=>'form-control col-md-7 col-xs-12',
                                        'default' => 'noticia',
                                        'required' => 'required',
                                        'label' => ['text' => '']
                                    ]);

                            ?> 
                        </div>
                    </div>
                  
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Importancia <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php 

                                 echo $this->Form->imput(
                                            'importancia',
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

                                $fecha= $this->Time->format($aviso->caduca, "dd/MM/yyyy", null);

                                echo $this->Form->input('caduca', [
                                        'type'=>'text',
                                        //'dateFormat' => 'DMY',
                                        'class'=>'datepicker form-control col-md-7 col-xs-12',
                                        //'required' => 'required',
                                        'label' => ['text' => ''],
                                        //'placeholder' => '_ _ / _ _ / _ _ _ _',
                                        //'templates'=>['dateWidget' => '{{day}}{{month}}{{year}}'],
                                        'value' => $fecha,
                                    ]);
                            ?> 
                        </div>
                    </div>
 
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