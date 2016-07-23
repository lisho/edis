
<div class="avisos form large-9 medium-8 columns content">
    <?= $this->Form->create($aviso) ?>
    <fieldset>
        <legend><?= __('Add Aviso') ?></legend>
        <?php
            echo $this->Form->input('titulo');
            echo $this->Form->input('description');
            echo $this->Form->input('tipo');
            echo $this->Form->input('importancia');
            echo $this->Form->input('caduca');
            echo $this->Form->input('user_id', ['options' => $users]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>




<h1>Nuevo Aviso / Noticia.</h1>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Crea un nuevo usuario en el sistema...</h2>
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
                                echo $this->Form->textarea('description', [
                                        'class'=>'form-control col-md-7 col-xs-12',
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
                                $tipos = ['noticia'=>'Noticia', 'aviso'=>'Aviso'];
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">importancia <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php
                                $importancia = ['alta'=>'Alta', 'media'=> 'Media', 'baja'=> 'Baja'];
                                echo $this->Form->select('importancia', $importancia, [
                                        'class'=>'form-control col-md-7 col-xs-12',
                                        'default' => 'media',
                                        'required' => 'required',
                                        'label' => ['text' => '']
                                    ]);
                            ?> 
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Teléfono <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php
                                echo $this->Form->input('telefono', [
                                        'class'=>'form-control col-md-7 col-xs-12',
                                        //'required' => 'required',
                                        'label' => ['text' => '']
                                    ]);
                            ?> 
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre de Usuario <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php
                                echo $this->Form->input('user', [
                                        'class'=>'form-control col-md-7 col-xs-12',
                                        'required' => 'required',
                                        'label' => ['text' => '']
                                    ]);
                            ?> 
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Contraseña <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php
                                echo $this->Form->input('password', [
                                        'class'=>'form-control col-md-7 col-xs-12',
                                        'required' => 'required',
                                        'label' => ['text' => '']
                                    ]);
                            ?> 
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Equipo de Referencia <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php
                            echo $this->Form->input('equipo_id', [
                                            'options' => $equipos,
                                            'class'=>'form-control col-md-7 col-xs-12',
                                            'required' => 'required',
                                            'label' => ['text' => '']
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