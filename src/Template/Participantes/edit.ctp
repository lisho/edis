<?= $this->assign('title', 'Editar: '.$participante->dni.'- '.$participante->nombre.' '.$participante->apellidos);?>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="icono-titulo-fa fa fa-user"><?= '  '.$participante->nombre.' '.$participante->apellidos?><small>  -Editar Ficha de Usuario </small></i></h2>
                <?= $this->Element('menus/menu_panel');?>                
                <div class="clearfix"></div>
            </div>
            <div class="x_content">    

                <!-- Formulario -->

                <?= $this->Form->create($participante,['type'=>'file','class'=>'form-horizontal form-label-left data-parsley-validate=""']) ?>
                

                <fieldset>
                                        
                    <?php
                                echo $this->Form->input('id', [
                                        'class'=>'',
                                        'required' => 'required',
                                        'label' => ['text' => ''],
                                    ]);
                            ?> 

                            <div class="form-group has-feedback">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">DNI/NIE <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        echo $this->Form->input('dni', [
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
                                        echo $this->Form->input('nombre', [
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
                                        echo $this->Form->input('apellidos', [
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
                                                    'sexo',
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
                                        $fecha= $this->Time->format($participante->nacimiento, "dd/MM/yyyy", null);
                                        echo $this->Form->input('nacimiento', [
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

                            <div class="form-group has-feedback">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Correo Electrónico <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        echo $this->Form->input('email', [
                                                'class'=>'form-control col-md-7 col-xs-12',
                                                //'required' => '',
                                                'label' => ['text' => '']
                                            ]);
                                    ?> 
                                </div>
                            </div>

                            <div class="form-group has-feedback">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telefono">Teléfono <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        echo $this->Form->input('telefono', [
                                                'class'=>'form-control col-md-7 col-xs-12',
                                                //'required' => '',
                                                'label' => ['text' => '']
                                            ]);
                                    ?> 
                                </div>
                            </div>

                             <div class="form-group has-feedback">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="relacion">Relación con el titular <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        echo $this->Form->input('relation_id', [
                                               'type' => 'select',
                                                    'class'=>'form-control col-md-7 col-xs-12',
                                                    'id' => 'relacion',
                                                    'default' => $participante->relation->id,
                                                    'required' => 'required',
                                                    'options' => $relaciones,
                                                    'label' => ['text' => ''],
                                                    //'empty'   => 'Elije un Rol para el técnico'
                                            ]);
                                    ?> 
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Observaciones sobre este USUARIO <span class="required">*</span></label>
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
                    <?= $this->Form->hidden('user_id', ['value' => $auth['id']] );?>    
                </fieldset>   

                <fieldset>
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Avatar<span class="required">*</span></label>
                    
                    <div class="form-group">
                         <div class="col-md-6 col-sm-6 col-xs-12">

                            <?php if ($participante['foto']!=''): ?>
                                  <?php $avatar= 'participantes_fotos/'.$participante['foto']; ?>
                                  <?= $this->Html->image($avatar, ['class'=>'img-circle avatar']);?>

                            <?php else: ?>
                                 <i class="fa fa-user fa-5x"></i>
                            <?php endif; ?>

                       
                            <h4 class="rojo_subrayado">Añadir/Cambiar foto de avatar:</h4>
        
                            <?= $this->Form->file('photo', [
                                            //'type'=>'file',
                                            //'label'=>'Selecciona un archivo para añadir la foto de perfil:'
                                            ]); ?>  
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





<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $participante->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $participante->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Participantes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Expedientes'), ['controller' => 'Expedientes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Expediente'), ['controller' => 'Expedientes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="participantes form large-9 medium-8 columns content">
    <?= $this->Form->create($participante) ?>
    <fieldset>
        <legend><?= __('Edit Participante') ?></legend>
        <?php
            echo $this->Form->input('dni');
            echo $this->Form->input('nombre');
            echo $this->Form->input('apellidos');
            echo $this->Form->input('nacimiento', ['empty' => true]);
            echo $this->Form->input('sexo');
            echo $this->Form->input('telefono');
            echo $this->Form->input('email');
            echo $this->Form->input('expediente_id', ['options' => $expedientes]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
