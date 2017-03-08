
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

                <div class="botonera pull-right">
                    
                    <br>
                        <?= $this->Html->link('', '#', [     
                                    'class'=> 'btn btn-md modal-btn btn-info fa fa-group',
                                    'id'=>'ver_info',
                                    'data-container'=>"body",
                                    'data-toggle'=>"popover",
                                    'data-placement'=>"left",
                                    'data-content'=>"Despliega más información sobre la parrilla familiar de este espediente."]) ?>

                </div>
        

                <!-- Formulario -->

                <?= $this->Form->create($expediente,['class'=>'form-horizontal form-label-left data-parsley-validate=""']) ?>

    <fieldset>
        
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
                            'label' => ['text' => '']
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

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12"><p>Ceas de referencia:</p>
                <?= $this->Html->link('', '#', [     
                                    'class'=> 'btn btn-xs modal-btn btn-info fa fa-edit',
                                    'id'=>'edita_ceas',
                                    'data-container'=>"body",
                                    'data-toggle'=>"popover",
                                    'data-placement'=>"right",
                                    'data-content'=>"Cambiar el CEAS de referencia para este expediente"]) ?>
                
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <h4>
                    <?= $listado_ceas[$expediente['ceas']]; ?></h4>
            </div>
        </div>

        <div class="form-group">

            <label class="control-label col-md-3 col-sm-3 col-xs-12"><p>Tecnicos de Referencia:</p>
            
            <?= $this->Html->link('', '#', [     
                                    'class'=> 'btn btn-xs modal-btn btn-success fa fa-plus',
                                    'id'=>'add_rol',
                                    'data-container'=>"body",
                                    'data-toggle'=>"popover",
                                    //'data-target'=>"#myModal",
                                    'data-placement'=>"right",
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
                                       
                                
                                <?= $this->Html->link('', '#', [
                                                    'class'=> 'btn btn-xs btn-info modal-btn fa fa-edit',
                                                    'id'=>'editar'.$rol->id,
                                                    'data-container'=>"body",
                                                    'data-toggle'=>"popover",
                                                    'data-placement'=>"top",
                                                    'data-content'=>"Editar este rol para este expediente."
                                                    ]) ?>
                        
                                <?= $this->Html->Link('', ['controller'=>'Roles', 'action' => 'delete', $rol->id], [
                                            'class'=> 'btn btn-xs btn-danger fa fa-trash', 
                                            'id'=>'borrar'.$rol->id,
                                            'data-container'=>"body",
                                            'data-toggle'=>"popover",
                                            'data-placement'=>"top",
                                            'data-content'=>"Eliminar rol para este expediente.",
                                            'confirm' => __('¿Realmente quieres borrar de este expediente a {0}?', $rol->tecnico->nombre.' '.$rol->tecnico->apellidos.' como '. $r )]) ?>
                 
                            </td>

                        </tr>

        <!-- Modal para editar un rol en un expediente  -->

                                <div id="modal_<?= 'editar'.$rol->id?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Editar el Rol del expediente <strong><?= $expediente['numedis']?></strong></h4>
                                      </div>
                                      <div class="modal-body">
                                        
                                        <?= $this->Form->create($rol,['class'=>'form-horizontal form-label-left data-parsley-validate=""']) ?>

                                                <?= $this->Form->input('roles.0.id', ['value'=>$rol->id, 'type'=>'hidden']);?> <!-- Avisamos al controlador de que hemos pasado un nuevo rol  -->

                                                <div class="form-group has-feedback">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Cambiar el Técnico<span class="required">*</span></label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <?php
                                                            echo $this->Form->input('roles.0.tecnico_id', [
                                                                                            'type' => 'select',
                                                                                            'class'=>'form-control col-md-7 col-xs-12',
                                                                                            'default' => '',
                                                                                            'id'=> 'tecnico_id',
                                                                                            'required' => 'required',
                                                                                            'label' => ['text' => ''],
                                                                                            'options' => $listado_tecnicos,
                                                                                            'default' => $rol->tecnico_id
                                                                                            //'empty'   => $rol->tecnico->nombre
                                                                                        ]);
                                                        ?> 
                                                    </div>
                                                </div>

                                                <div class="form-group has-feedback">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Cambiar el Rol <span class="required">*</span></label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <?php
                                                            echo $this->Form->input('roles.0.rol', [
                                                                                            'type' => 'select',
                                                                                            'class'=>'form-control col-md-7 col-xs-12',
                                                                                            'id' => 'rol',
                                                                                            'default' => '',
                                                                                            'required' => 'required',
                                                                                            'label' => ['text' => ''],
                                                                                            'options' => $opciones_rol,
                                                                                            'default' => $rol->rol
                                                                                        ]);
                                                        ?> 
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Observaciones sobre este Rol <span class="required">*</span></label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <?php
                                                            echo $this->Form->input('roles.0.observaciones', [
                                                                    'class'=>'form-control col-md-7 col-xs-12',
                                                                    //'required' => 'required',
                                                                    'label' => ['text' => ''],
                                                                    'default' => $rol->observaciones
                                                                ]);
                                                        ?> 
                                                    </div>
                                                </div>

                                               <?= $this->Form->input('aviso', ['value'=>'nuevo_rol', 'type'=>'hidden']);?>   <!--Avisamos al controlador de que hemos pasado un nuevo rol  -->


                                                <div class="modal-footer">
                                                    <?= $this->Form->button('Guardar cambios en el rol ->', ['class' => 'btn btn-success']) ?>
                                                    <?= $this->Html->link('Cerrar', ['action'=>'index'],['class' => 'btn btn-primary','data-dismiss'=>"modal"]) ?>
                                                    
                            
                                                </div>
                                            
                                        <?= $this->Form->end() ?>
                                        
                                    </div>
                                  </div>
                                </div> <!--// FIN Modal para editar un rol en un expediente  -->

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
    </fieldset>

    <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <?= $this->Form->button('Guardar cambios en el expediente ->', ['class' => 'btn btn-success']) ?>
                <?= $this->Html->link(__('Cancel'), ['action'=>'view',$expediente->id],['class' => 'btn btn-primary']) ?>
                <?= $this->Form->postLink('', ['action' => 'delete', $expediente->id], ['class'=> 'fa fa-trash text-danger icono-titulo-fa pull-right', 'confirm' => __('Realmente quieres borrar el expediente: # {0}?', $expediente->numedis), 'id' => 'borra_expediente',
                                                                    'data-toggle'=>"popover",
                                                                    'data-placement'=>"top",
                                                                    'data-content'=>"¡ATENCIÓN! Si eliminas este expediente eliminarás todos los datos y usuarios asociados a él  ¡PIÉNSALO DE NUEVO!."]) ?> 
                    </div>
                </div>
               
    <?= $this->Form->end() ?>


    <!-- 
    ****************************
    ***** M O D A L E S ********
    ****************************
    -->

 <!-- Modal para formulario de nuevo rol en un expediente  -->


<div id="modal_add_rol" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Añadir un Nuevo Rol al Expediente <strong><?= $expediente['numedis']?></strong></h4>
      </div>
      <div class="modal-body">
        
        <?= $this->Form->create('',['class'=>'form-horizontal form-label-left data-parsley-validate=""']) ?>

            <div class="form-group has-feedback">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nuevo Técnico <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?php
                    echo $this->Form->input('roles.0.tecnico_id', [
                                                    'type' => 'select',
                                                    'class'=>'form-control col-md-7 col-xs-12',
                                                    'id' => 'tecnico_ceas',
                                                    //'default' => '',
                                                    'required' => 'required',
                                                    'label' => ['text' => ''],
                                                    'options' => $listado_tecnicos,
                                                    'empty'   => 'Elije el técnico al que desea asignar un rol'
                                                ]);
                ?> 
            </div>
        </div>

        <div class="form-group has-feedback">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nuevo Rol <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?php
                   
                    echo $this->Form->input('roles.0.rol', [
                                                    'type' => 'select',
                                                    'class'=>'form-control col-md-7 col-xs-12',
                                                    'id' => 'tecnico_inclusion',
                                                    //'default' => '',
                                                    'required' => 'required',
                                                    'options' => $opciones_rol,
                                                    'label' => ['text' => ''],
                                                    'empty'   => 'Elije un Rol para el técnico'
                                                ]);
                ?> 
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Observaciones sobre este Rol <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?php
                    echo $this->Form->input('roles.0.observaciones', [
                            'class'=>'form-control col-md-7 col-xs-12',
                            //'required' => 'required',
                            'label' => ['text' => '']
                        ]);
                ?> 
            </div>
        </div>

            <!-- <?= $this->Form->input('aviso', ['value'=>'nuevo_rol', 'type'=>'hidden']);?>  Avisamos al controlador de que hemos pasado un nuevo rol  -->

      </div>
      <div class="modal-footer">
        <?= $this->Form->button('Añadir el nuevo Rol al expediente ->', ['class' => 'btn btn-success']) ?>
        <?= $this->Html->link('Cerrar', ['action'=>'index'],['class' => 'btn btn-primary','data-dismiss'=>"modal"]) ?>
        
      </div>

        <?= $this->Form->end() ?>
        
    </div>
  </div>
</div>


<!-- Modal para formulario de información adicional sobre un expediente  -->

<div id="modal_ver_info" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">información adicional sobre el Expediente: <strong><?= $expediente['numedis']?></strong></h4>
      </div>
      <div class="modal-body">
        
        <h4>Parrilla familiar</h4><hr>

            <table  class="table table-bordered">
                <thead>  
                    <th>DNI</th>                   
                    <th>Nombre</th>
                    <th>Relacion con titular</th> 
                    <th>Observaciones</th>                                     
                </thead>
                <tbody>
                    <?php foreach ($expediente->participantes as $participante): ?>
                    <tr> 
                        <td><?= $participante->dni?></td>   
                        <td><?= $participante->nombre.' '. $participante->apellidos?></td>
                        <td><?= $participante->relation->nombre?></td>
                        <th><?= $participante->observaciones?></th>
                    </tr>
                    <?php endforeach ?>
                </tbody>               
            </table>
        
      </div>
      <div class="modal-footer">
       
        <?= $this->Html->link('Cerrar', ['action'=>'index'],['class' => 'btn btn-primary','data-dismiss'=>"modal"]) ?>
        
      </div>
    </div>
  </div>
</div>


 <!-- Modal para editar el CEAS de referencia para el expediente  -->


<div id="modal_edita_ceas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cambia el CEAS de referencia para este Expediente <strong><?= $expediente['numedis']?></strong></h4>
      </div>
      <div class="modal-body">
        
        <?= $this->Form->create($expediente,['class'=>'form-horizontal form-label-left data-parsley-validate=""']) ?>

            <div class="form-group has-feedback">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nuevo CEAS de Referencia <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?php
                    echo $this->Form->input('ceas', [
                                                    'type' => 'select',
                                                    'class'=>'form-control col-md-7 col-xs-12',
                                                    'id' => 'tecnico_ceas',
                                                    'default' => $expediente->ceas,
                                                    'required' => 'required',
                                                    'label' => ['text' => ''],
                                                    'options' => $listado_ceas
                                                ]);
                ?> 
            </div>
        </div>

            <?= $this->Form->input('volver', ['value'=>'volver', 'type'=>'hidden']);?> <!-- Avisamos al controlador de que hemos pasado un nuevo rol  -->

      </div>
      <div class="modal-footer">
        <?= $this->Form->button('Guardar cambios en el CEAS ->', ['class' => 'btn btn-success']) ?>
        <?= $this->Html->link('Cerrar', ['action'=>'index'],['class' => 'btn btn-primary','data-dismiss'=>"modal"]) ?>
        
      </div>

        <?= $this->Form->end() ?>
        
    </div>
  </div>
</div>