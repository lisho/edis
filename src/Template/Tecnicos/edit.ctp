
<h1>Editar Técnico.</h1>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Modifica los datos de uno de los técnicos que intervienen en los casos.</h2>
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

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php
                                echo $this->Form->input('email', [
                                        'class'=>'form-control col-md-7 col-xs-12',
                                        //'required' => 'required',
                                        'label' => ['text' => '']
                                    ]);
                            ?> 
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Telefono <span class="required">*</span></label>
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
                                                'Tecnico/a Inmigración' => 'Tecnico/a Inmigración' ]; // Cambiar tambien en add

                                echo $this->Form->input('puesto', [
                                                                    'type' => 'select',
                                                                    'class'=>'form-control col-md-7 col-xs-12',
                                                                    'id' => 'puesto',
                                                                    'required' => 'required',
                                                                    'label' => ['text' => ''],
                                                                    'options' => $puestos,
                                                                    'default' => $tecnico->puesto
                                                                ]);


                            ?> 
                        </div>
                    </div>

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