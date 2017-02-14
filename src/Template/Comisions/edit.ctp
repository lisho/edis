<h1>Editar la Comisión de <?= $comision->tipo; ?><small><?= ' '.$this->Time->format($comision->fecha, "dd/MM/yyyy", null); ?></small></h1> 
<div class="row"> 
    <div class="col-md-12 col-sm-12 col-xs-12"> 
        <div class="x_panel"> 
            <div class="x_title"> 
                <h2>Modifica los datos asociados a la Comisión de <strong><?= $comision->tipo; ?><small><?= ' '.$this->Time->format($comision->fecha, "dd/MM/yyyy", null); ?></small></strong></h2> 

                <?= $this->Element('menus/menu_panel');?>                 
                <div class="clearfix"></div> 
            </div> 
            <div class="x_content">     
                <br><br>
                <!-- Formulario --> 
                    <?= $this->Form->create($comision,[
                                                    'class'=>'form-horizontal form-label-left data-parsley-validate=""'
                                                    ]); ?>

                    <?php

                            echo $this->Form->input('id', [
                                    'type' =>'hidden',
                                ]);
                        ?> 

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha de la comisión <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php
                            $fecha= $this->Time->format($comision->fecha, "dd/MM/yyyy", null);
                            echo $this->Form->input('fecha', [
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

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo de comisión <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php

                            echo $this->Form->input('tipo', [
                                    'type' => 'radio',
                                            'options'=>[
                                                ['value'=>'RGC', 'text'=>'RGC'], ['value'=>'AUS', 'text'=>'AUS']],
                                            'templates' => [
                                                'radioWrapper' => '<div class="radio-inline screen-center screen-radio">{{label}}</div>'
                                            ], 
                                            'label' =>['text' => ''],
                                            //'label' => ["class" => "radio"]

                                ]);
                        ?> 
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Observaciones sobre esta comisión <span class="required">*</span></label>
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
            <div class="modal-footer">
                <?= $this->Form->button('Guardar cambios ->', ['class' => 'btn btn-success']) ?>
                <?= $this->Html->link('Cerrar', ['action'=>'view', $comision->id],['class' => 'btn btn-primary','data-dismiss'=>"modal"]) ?>
                
            </div>
               
                <?= $this->Form->end() ?>
            </div>  
                <!-- /Formulario --> 
        </div> 
    </div> 
</div>
 

