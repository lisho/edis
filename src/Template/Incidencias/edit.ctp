<h1><i class="fa fa-pencil-square-o"></i>  Editar una incidencia.</h1>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Edita la incidencia que generaste para el expediente <big><strong> <?= $incidencia->expediente->numedis; ?></strong></big> (Historia Social: <?= $incidencia->expediente->numhs; ?>)</h2>
                <?= $this->Element('menus/menu_panel');?>                
                <div class="clearfix"></div>
            </div>
            <div class="x_content">    

                <!-- Formulario -->

                <?= $this->Form->create($incidencia,['class'=>'form-horizontal form-label-left data-parsley-validate=""']) ?>
                

                <fieldset>
                     
                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php
                                $fecha_creado= $this->Time->format($incidencia->fecha, "dd/MM/yyyy", null);
                                echo $this->Form->input('fecha', [
                                        'type'=>'text',
                                        'default' => date('d/m/Y'),
                                        //'dateFormat' => 'DMY',
                                        'class'=>'datepicker form-control col-md-7 col-xs-12',
                                        //'required' => 'required',
                                        'label' => ['text' => ''],
                                        'value' => $fecha_creado,
                                        'placeholder' => '_ _ / _ _ / _ _ _ _'
                                        //'templates'=>['dateWidget' => '{{day}}{{month}}{{year}}']
                                    ]);
                            ?> 
                        </div>
                    </div>                   
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php
                                echo $this->Form->input('incidenciatipo_id', [
                                        'type' => 'select',
                                        'class'=>'form-control col-md-7 col-xs-12',
                                        'default' => '',
                                        'required' => 'required',
                                        'label' => ['text' => ''],
                                        'options' => $incidenciatipos,
                                        'empty'   => 'Selecciona un tipo de incidencia...'
                                    ]);
                            ?> 
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripción <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php
                                echo $this->Form->textarea('descripcion', [
                                    'class'=>'editor form-control col-md-7 col-xs-12',
                                    //'required' => 'required',
                                    'label' => ['text' => '']
                                ]);
                            ?> 
                        </div>
                    </div>

                    <?php // $this->Form->input('expediente_id', ['type'=>'hidden', 'value'=>$expediente->id]);?>
                    <?php // $this->Form->input('user_id', ['type'=>'hidden', 'value'=>$auth->id]);?>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Expediente <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php
                                echo $this->Form->input('expediente_id', [
                                        'type' => 'hidden',
                                        'class'=>'form-control col-md-7 col-xs-12',
                                        'default' => '',
                                        'required' => 'required',
                                        'label' => ['text' => ''],
                                        'options' => $expedientes,
                                        'empty'   => 'Selecciona un expediente...'
                                    ]);
                            ?> 
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Creado por <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php
                                echo $this->Form->input('user_id', [
                                        'type' => 'hidden',
                                        'class'=>'form-control col-md-7 col-xs-12',
                                        'default' => '',
                                        'required' => 'required',
                                        'label' => ['text' => ''],
                                        'options' => $users,
                                        'empty'   => 'Selecciona un usuario...'
                                    ]);
                            ?> 
                        </div>
                    </div>

                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success']) ?>
                <?= $this->Html->link(__('Cancel'), ['action'=>'index'],['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
               
                <?= $this->Form->end() ?>
                <!-- /END Formulario -->
            </div>
        </div>
    </div>
</div>