

<h1>Nuevo Usuario.</h1>
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

                <?= $this->Form->create($user,['type'=>'file', 'class'=>'form-horizontal form-label-left']) ?>
                

                <fieldset>
                                        
                    <div class="form-group">
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

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php
                                echo $this->Form->input('nombre', [
                                        'class'=>'form-control col-md-7 col-xs-12',
                                        //'required' => 'required',
                                        'label' => ['text' => '']
                                    ]);
                            ?> 
                        </div>
                    </div>

                    <div class="form-group">
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

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Correo Electrónico <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php
                                echo $this->Form->input('email', [
                                        'class'=>'form-control col-md-7 col-xs-12',
                                        'required' => 'required',
                                        'label' => ['text' => '']
                                    ]);
                            ?> 
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Teléfono <span class="required">*</span></label>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre de Usuario <span class="required">*</span></label>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Contraseña <span class="required">*</span></label>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Rol en el sistema <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php
                            echo $this->Form->select('role', ['admin'=>'Administrador', 'ceas'=> 'CEAS', 'edis'=> 'EDIS', 'invitado'=> 'Invitado'], [
                                        'class'=>'form-control col-md-7 col-xs-12',
                                        'required' => 'required',
                                        'label' => ['text' => ''],
                                        
                                    ]);
                        ?> 
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Equipo de Referencia <span class="required">*</span></label>
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

                    <fieldset>
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Avatar<span class="required">*</span></label>
                    
                    <div class="form-group">
                         <div class="col-md-6 col-sm-6 col-xs-12">
                       
                             <h4 class="rojo_subrayado">Añadir foto de perfil:</h4>
        
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