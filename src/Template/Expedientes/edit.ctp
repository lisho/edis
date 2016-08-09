
<h1><small>Expediente EDIS: </small><?= $expediente->numedis?></h1>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            
            <div class="x_title">
                <h2>Edita el expediente </h2>
                <?= $this->Element('menus/menu_panel');?>                
                <div class="clearfix"></div>
            </div>
            <div class="x_content">    
        

                <!-- Formulario -->

                <?= $this->Form->create($expediente,['class'=>'form-horizontal form-label-left data-parsley-validate=""']) ?>

    <fieldset>

        <br>
        <h4>Si no has obtenido ningún resultado en el buscador anterior, puedes iniciar la <strong>creación de un nuevo expediente</strong>: </h4> <hr>
        
        <div class="form-group has-feedback">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Número de Expediente EDIS <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?php
                    echo $this->Form->input('numedis', [
                            'class'=>'form-control col-md-7 col-xs-12',
                            'required' =>'required',
                            'label' => ['text' => '']
                        ]);
                ?> 
            </div>
        </div>

        <div class="form-group has-feedback">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Número de Expediente RGC <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?php
                    echo $this->Form->input('numrgc', [
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
                            'label' => ['text' => '']
                        ]);
                ?> 
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Ceas de referencia: <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <h4><?= $listado_ceas[$expediente['ceas']]; ?></h4>
            </div>
        </div>

        <div class="form-group">

            <label class="control-label col-md-3 col-sm-3 col-xs-12"><p>Tecnicos de Referencia:</p>
            
            <?= $this->Html->link('', ['controller'=>'roles', 'action' => 'add', $expediente->id], [     
                                    'class'=> 'btn btn-xs btn-success fa fa-plus',
                                    'id'=>'add_tecnico',
                                    'data-container'=>"body",
                                    'data-toggle'=>"modal",
                                    'data-target'=>"#myModal",
                                    'data-placement'=>"left",
                                    'data-content'=>"Añadir un nuevo técnico a este expediente."]) ?>

            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">         
                <table id="" class="table table-striped table-bordered " cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <!-- <th></th> -->
                            <th>Técnico</th>
                            <th>Rol</th>
                            <th>Equipo de Referencia</th>
                            <th>Observaciones</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($expediente->roles as $rol): ?>
                        <tr>
                        <!--
                            <td class="foto-lista"><?= $this->Html->image('user_fotos/'.$aviso['user']['foto'], ['class'=> 'img-circle profile_img']) ?>  </td>
                        -->

                            <?php 

                                switch ($rol['rol']) {
                                    case 'CC':
                                        $r = 'Coordinador de Caso';
                                        break;
                                    case 'tedis':
                                        $r = 'Técnico de Inclusión';
                                        break; 
                                    default:
                                        $r = 'Otro rol por definir';
                                        break;                          
                                }
                            ?>
                            
                            <td><?= $rol->tecnico->nombre.' '.$rol->tecnico->apellidos  ?></td>
                            <td><?= $r ?></td>
                            <td><?= $rol->tecnico->equipo->nombre ?></td>
                            <td><?= $rol->observaciones ?></td>
                            <td>  
                                       
                                <?= $this->Html->link('', ['controller'=>'tecnicos', 'action' => 'view', $rol->tecnico->id], [     
                                                    'class'=> 'btn btn-xs btn-dark fa fa-user',
                                                    'id'=>'ver'.$rol->tecnico->id,
                                                    'data-container'=>"body",
                                                    'data-toggle'=>"popover",
                                                    'data-placement'=>"left",
                                                    'data-content'=>"Ver la ficha de este técnico."]) ?>
                     
                                <?= $this->Html->link('', ['controller'=>'roles', 'action' => 'edit', $rol->id], [
                                                    'class'=> 'btn btn-xs btn-info fa fa-edit',
                                                    'id'=>'editar'.$rol->tecnico->id,
                                                    'data-container'=>"body",
                                                    'data-toggle'=>"popover",
                                                    'data-placement'=>"top",
                                                    'data-content'=>"Editar este rol para este expediente."
                                                    ]) ?>
                                
                                <?= $this->Form->postLink('', ['action' => 'delete', $rol->id], [
                                            'class'=> 'btn btn-xs btn-danger fa fa-trash', 
                                            'id'=>'borrar'.$rol->tecnico->id,
                                            'data-container'=>"body",
                                            'data-toggle'=>"popover",
                                            'data-placement'=>"right",
                                            'data-content'=>"Eliminar rol para este expediente.",
                                            'confirm' => __('¿Realmente quieres borrar de este expediente a {0}?', $rol->tecnico->nombre.' '.$rol->tecnico->apellidos.' como '. $r )]) ?>
                                
                            </td>

                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
<!--
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
                                                    'empty'   => 'Elije un Ceas'
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
                                                    'empty'   => 'Elije un Coordinador de Caso'
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
                                                    'empty'   => 'Elije un Técnico de Inclusión',
                                                    'selected' => '',
                                                ]);
                ?> 
            </div>
        </div>
-->   
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
        
    </fieldset>

    <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <?= $this->Form->button('Guardar cambios en el expediente ->', ['class' => 'btn btn-success']) ?>
                <?= $this->Html->link(__('Cancel'), ['action'=>'index'],['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
               
    <?= $this->Form->end() ?>




    <div id="myModal" class="modal fade bs-example-modal-lg">
        
        <?= $this->Form->create($expediente,['class'=>'form-horizontal form-label-left data-parsley-validate=""']) ?>

        <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <?= $this->Form->button('Guardar cambios en el expediente ->', ['class' => 'btn btn-success']) ?>
                <?= $this->Html->link(__('Cancel'), ['action'=>'index'],['class' => 'btn btn-primary']) ?>
                    </div>
                </div>

        <?= $this->Form->end() ?>
    </div>

</div>