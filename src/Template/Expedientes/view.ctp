<?= $this->assign('title', $expediente->numedis);?>
<div class="col-md-4 col-sm-12 col-xs-12"> 
    <div class="x_panel"> <!-- Panel de datos de expediente-->
        <div class="x_title"> 
            <h2><i class="icono-titulo-fa fa fa-folder-open"><?= '  '.h($expediente->numedis) ?> </i></h2> 
            <ul class="nav navbar-right panel_toolbox"> 
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> 
              </li> 
              <li class="dropdown"> 
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a> 
                <ul class="dropdown-menu" role="menu"> 
                  <li><a href="#">Settings 1</a> 
                  </li> 
                  <li><a href="#">Settings 2</a> 
                  </li> 
                </ul> 
              </li> 
              <li><a class="close-link"><i class="fa fa-close"></i></a> 
              </li> 
            </ul> 
            <div class="clearfix"></div> 
        </div> 
 
        <div class="x_content">         
            <h3>Datos del expediente:</h3>
            <table class="vertical-table"> 
                 
               <tr>
                    <th><?= 'Número de Expediente EDIS' ?></th>
                    <td><?= h($expediente->numedis) ?></td>

                </tr>
                <tr>
                    <th><?= 'Numero de Historia Social (SAUSS)' ?></th>
                    <td><?= h($expediente->numhs) ?></td>
                </tr>
                <tr>
                    <th><?= 'Domicilio' ?></th>
                    <td><?= h($expediente->domicilio) ?></td>
                </tr>
                
                <tr>
                    <th><?= 'Fecha de creación del expediente:' ?></th>
                    <td><?= $this->Time->format($expediente->created, "dd/MM/yyyy", null); ?></td>
                </tr>
                <tr>
                    <th><?= 'Última modificación en el expediente:' ?></th>
                    <td><?= $this->Time->format($expediente->modified, "dd/MM/yyyy", null); ?></td>
                </tr>
                
            </table> 
                    <br>
                    <p><b><?= 'CEAS de Referencia:' ?></b></p>
                    <p><?= $listado_ceas[$expediente->ceas]; ?></p>
                    
                    <p><b><?= 'Observaciones sobre el expediente:' ?></b></p>
                    <?php if ($expediente->observaciones!=null): ?>
                         <?= $expediente->observaciones; ?>
                    <?php else: ?>
                        <p>No se han generado observaciones para este expediente</p>
                    <?php endif ?>
                   

                 
                <br> <hr>
                <?= $this->Html->link('', ['action' => 'index'], ['class'=> 'fa fa-backward text-primary icono-titulo-fa']) ?> 
                <?= $this->Html->link('', ['action' => 'edit', $expediente->id], ['class'=> 'fa fa-edit text-info icono-titulo-fa']) ?> 
                <?= $this->Form->postLink('', ['action' => 'delete', $expediente->id], ['class'=> 'fa fa-trash text-danger icono-titulo-fa', 'confirm' => __('Realmente quieres borrar el expediente: # {0}?', $expediente->numedis)]) ?> 
                

        </div> <!--// Fin Panel de datos de expediente-->
    </div>

    <div class="x_panel"> <!--/ Panel de Tecnicos-->
        <div class="x_title"> 
            <big><i class="icono-fa fa fa-list-ul"></i><?= '    Técnicos asociados a este expediente:' ?> </big>
            <ul class="nav navbar-right panel_toolbox"> 
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> 
              </li> 
              <li class="dropdown"> 
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a> 
                <ul class="dropdown-menu" role="menu"> 
                  <li><a href="#">Settings 1</a> 
                  </li> 
                  <li><a href="#">Settings 2</a> 
                  </li> 
                </ul> 
              </li> 
              <li><a class="close-link"><i class="fa fa-close"></i></a> 
              </li> 
            </ul> 
            <div class="clearfix"></div> 
        </div> 
 
        <div class="x_content">         

            <div class="clearfix"></div> 
            <div class="related"> 
                
                <?php if (!empty($expediente->roles)): ?> 
                <table id="" class="table table-striped table-bordered" cellpadding="0" cellspacing="0"> 

                    <tr> 
                        
                        <th><?= __('Tecnico Id') ?></th>
                        <th><?= __('Rol') ?></th>
                        <th><?= __('Observaciones') ?></th>
                        
                        <?php if ($auth['role'] === 'admin'): ?>
                            <th class="actions"><?= __('Actions') ?></th>
                        <?php endif; ?>
                    </tr> 
                    <?php foreach ($expediente->roles as $roles): ?> 
                    <tr> 

                    <?php 

                        switch ($roles['rol']) {
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

                       
                        <td><?= $roles->tecnico->nombre.' '.$roles->tecnico->apellidos ?></td>
                        <td><?= h($r) ?></td>
                        <td><?= h($roles->observaciones) ?></td>
                        <?php if ($auth['role'] === 'admin'): ?>
                             <td class="actions">
                                <?= $this->Html->link('', ['controller' => 'Roles', 'action' => 'view', $roles->id], ['class'=> 'fa fa-eye text-primary icono-tabla-fa']) ?>
                                <?= $this->Html->link('', ['controller' => 'Roles', 'action' => 'edit', $roles->id], ['class'=> 'fa fa-edit text-info icono-tabla-fa']) ?>
                                <?= $this->Form->postLink('', ['controller' => 'Roles', 'action' => 'delete', $roles->id], ['class'=> 'fa fa-trash text-danger icono-tabla-fa','confirm' => __('Are you sure you want to delete # {0}?', $roles->id)]) ?>
                            </td>      
                        <?php endif; ?>
                        
                    </tr> 
                    <?php endforeach; ?> 
                </table> 
 
                <?php endif; ?> 
 
            </div> <!--/ FIN Roles-->

        </div> 
    </div>



</div><!--// FIN DIV col-md-4 col-sm-12 col-xs-12-->

<!--Participantes: PARRILLA FAMILIAR-->

<div class="col-md-8 col-sm-12 col-xs-12"> 
    <div class="fijo">
        <?= $this->Html->link('',[],['class'=>'default fa fa-close fijo-boton', 'id'=>'cerrar_ventana', 'data-expediente'=>$expediente->numedis,'data-container'=>"body",
                'data-toggle'=>"popover",
                'data-placement'=>"left",
                'data-content'=>"Cerrar este expediente"
            ]); ?> 

    </div>

    <div class="x_panel"> 
        <div class="x_title"> 
            <big><i class="icono-fa fa fa-group"></i><?= '  Parrilla Familiar de este expediente:' ?></big> 
             <?= $this->Html->link('', '#', [     
                                    'class'=> 'btn btn-xs modal-btn btn-info fa fa-plus',
                                    'id'=>'add_participante',
                                    'data-container'=>"body",
                                    'data-toggle'=>"popover",
                                    'data-placement'=>"right",
                                    'data-content'=>"Añade un nuevo miembro a esta parrilla..."]) ?>
            <ul class="nav navbar-right panel_toolbox"> 
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> 
              </li> 
              <li class="dropdown"> 
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a> 
                <ul class="dropdown-menu" role="menu"> 
                  <li><a href="#">Settings 1</a> 
                  </li> 
                  <li><a href="#">Settings 2</a> 
                  </li> 
                </ul> 
              </li> 
              <li><a class="close-link"><i class="fa fa-close"></i></a> 
              </li> 
            </ul> 
            <div class="clearfix"></div> 
        </div> 
 
        <div class="x_content">        

            <div class="related"> 
                
                <?php if (!empty($expediente->participantes)): ?> 

                <table id="" class="table table-striped table-bordered" cellpadding="0" cellspacing="0"> 
                    <tr> 
                        <th></th>
                        <th><?= __('Dni') ?></th>
                        <th><?= __('Nombre') ?></th>
                        <th><?= __('Apellidos') ?></th>
                        <th><?= __('Relación') ?></th>      
                        <th><?= __('Edad') ?></th>           
                        <th><?= __('Telefono') ?></th>
                        <th><?= __('Email') ?></th>
                        
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>

                    <?php $p=0; ?>  
                    <?php foreach ($expediente->participantes as $participantes): ?> 
                        
                        <!-- Iconos de la Parrilla segun edad y sexo -->
                        <?php 
                        
                            switch ($participantes['sexo']) {
                                case 'M':
                                    if ($participantes['edad']===null) {
                                        $sexo = $this->Html->image('parrilla/male-desconocido.svg', ['class' =>'icono-parrilla-adulto', 
                                            'id'=>$participantes['id'],
                                            'data-toggle'=>"popover",
                                            'data-placement'=>"right",
                                            'data-content'=>"Hombre de edad desconocida"
                                            ]);
                                    }elseif ($participantes['edad']<3) {
                                        $sexo = $this->Html->image('parrilla/bebe-b.svg', ['class' =>'icono-parrilla-niño',
                                            'id'=>$participantes['id'],
                                            'data-toggle'=>"popover",
                                            'data-placement'=>"right",
                                            'data-content'=>"Niño menor de 3 años."
                                            ]);
                                    }elseif ($participantes['edad']<16) {
                                        $sexo = $this->Html->image('parrilla/boy.svg', ['class' =>'icono-parrilla-niño',
                                            'id'=>$participantes['id'],
                                            'data-toggle'=>"popover",
                                            'data-placement'=>"right",
                                            'data-content'=>"Niño menor de 16 años."
                                            ]);
                                    }elseif ($participantes['edad']>65) {
                                        $sexo = $this->Html->image('parrilla/grandmale.svg', ['class' =>'icono-parrilla-adulto',
                                            'id'=>$participantes['id'],
                                            'data-toggle'=>"popover",
                                            'data-placement'=>"right",
                                            'data-content'=>"Hombre mayor de 65 años."
                                            ]);
                                    }else {
                                        $sexo = $this->Html->image('parrilla/male.svg', ['class' =>'icono-parrilla-adulto',
                                            'id'=>$participantes['id'],
                                            'data-toggle'=>"popover",
                                            'data-placement'=>"right",
                                            'data-content'=>"Hombre mayor de 16 años."]);
                                    } 
                                    break;

                                case 'F':
                                    if ($participantes['edad']===null) {
                                        $sexo = $this->Html->image('parrilla/female-desconocida.svg', ['class' =>'icono-parrilla-adulto',
                                            'id'=>$participantes['id'],
                                            'data-toggle'=>"popover",
                                            'data-placement'=>"right",
                                            'data-content'=>"Mujer de edad desconocida"
                                            ]);
                                    }elseif ($participantes['edad']<3) {
                                        $sexo = $this->Html->image('parrilla/bebe-g.svg', ['class' =>'icono-parrilla-niño',
                                            'id'=>$participantes['id'],
                                            'data-toggle'=>"popover",
                                            'data-placement'=>"right",
                                            'data-content'=>"Niña menor de 3 años."
                                            ]);
                                    }elseif ($participantes['edad']<16) {
                                        $sexo = $this->Html->image('parrilla/girl.svg', ['class' =>'icono-parrilla-niño',
                                            'id'=>$participantes['id'],
                                            'data-toggle'=>"popover",
                                            'data-placement'=>"right",
                                            'data-content'=>"Niña menor de 16 años."
                                            ]);
                                    }elseif ($participantes['edad']>65) {
                                        $sexo = $this->Html->image('parrilla/grandfemale.svg', ['class' =>'icono-parrilla-adulto',
                                            'id'=>$participantes['id'],
                                            'data-toggle'=>"popover",
                                            'data-placement'=>"right",
                                            'data-content'=>"Mujer mayor de 65 años."
                                            ]);
                                    }else {
                                        $sexo = $this->Html->image('parrilla/female.svg', ['class' =>'icono-parrilla-adulto','id'=>$participantes['id'],
                                            'data-toggle'=>"popover",
                                            'data-placement'=>"right",
                                            'data-content'=>"Mujer mayor de 16 años."]);
                                    } 
                                    break;                            
                            }
                         ?>

                    <tr> 
                        <td><?= $sexo;?></td>
                        <td><?= h($participantes->dni) ?></td>
                        <td><?= h($participantes->nombre) ?></td>
                        <td><?= h($participantes->apellidos) ?></td>
                        <td><?= h($participantes->relation->nombre) ?></td>
                        <td>
                            <?php if ($participantes->nacimiento): ?>
                                 <?= '<b>'.$participantes->edad .' años </b> ('.$this->Time->format($participantes->nacimiento, "dd/MM/yyyy", null).')';?> 
                            <?php else: ?>
                                    <?= $this->Html->link(' Fecha Nacimiento', '#', [     
                                        'class'=> 'btn btn-xs modal-btn btn-warning fa fa-plus',
                                        'id'=>'add_fecha_nacimiento_'.$participantes->id,
                                        'data-container'=>"body",
                                        //'data-toggle'=>"popover",
                                        //'data-placement'=>"right",
                                        //'data-content'=>"Añade un nuevo miembro a esta parrilla..."
                                        ]); ?>

                            <?php endif ?>
                        </td>
                        <td><?= h($participantes->telefono) ?></td>
                        <td><?= h($participantes->email) ?></td>
                        
                        <td class="actions">
                            <?= $this->Html->link('', ['controller' => 'Participantes', 'action' => 'view', $participantes->id],['class'=> 'fa fa-eye text-info icono-tabla-fa']) ?>
                            <?= $this->Html->link('', ['controller' => 'Participantes', 'action' => 'edit', $participantes->id],['class'=> 'fa fa-edit text-primary icono-tabla-fa']) ?>
                            <?= $this->Form->postLink('', ['controller' => 'Participantes', 'action' => 'delete', $participantes->id], ['class'=> 'fa fa-trash text-danger icono-fa','confirm' => __('Estás seguro de que quieres borrar a # {0}?', $participantes->nombre.' '.$participantes->apellidos)]) ?>
                        </td>
                    </tr> 
                    <?php $p++; ?>
                    <?php endforeach; ?> 
                </table> 
 
                <?php endif; ?> 
 
            </div> <!--/ FIN Participantes-->
        </div> 
    </div>
</div>

<div class="col-md-8 col-sm-12 col-xs-12"> 
    <div class="x_panel"> 
        <div class="x_title"> 
             <big><i class="icono-fa fa fa-list"></i><?= '  Actuaciones:' ?></big> 
             <?= $this->Html->link('', '#', [     
                                    'class'=> 'btn btn-xs modal-btn btn-info fa fa-plus',
                                    'id'=>'add_incidencia',
                                    'data-container'=>"body",
                                    'data-toggle'=>"popover",
                                    'data-placement'=>"right",
                                    'data-content'=>"Crea una nueva incidencia para este expediente..."]) ?>
            <ul class="nav navbar-right panel_toolbox"> 
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> 
              </li> 
              <li class="dropdown"> 
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a> 
                <ul class="dropdown-menu" role="menu"> 
                  <li><a href="#">Settings 1</a> 
                  </li> 
                  <li><a href="#">Settings 2</a> 
                  </li> 
                </ul> 
              </li> 
              <li><a class="close-link"><i class="fa fa-close"></i></a> 
              </li> 
            </ul> 
            <div class="clearfix"></div> 
        </div>
        <div class="x_content">
            <ul class="list-unstyled timeline">                
                
                <?php
                    // Ordenamos el array por la fecha de la incidencia
                    $incidencias = $expediente->incidencias;
                    uasort($incidencias, 'ordename');
                    function ordename ($a, $b) {
                        return $a['fecha'] < $b['fecha'];
                    }

                ?>
                <?php foreach ($incidencias as $incidencia): ?>
                   <!--
                   <li>
                        <?= $this->Html->image('user_fotos/'.$incidencia->user->foto, ['class'=> 'avatar']); ?>

                        <div class="message_date">
                          <h4 class="date text-info"><?= '<small>'.$this->Time->format($incidencia->fecha, "dd/MM/yyyy", null).'</small>'?> </h4>
                            
                            <?= $this->Html->link('', '#',['id'=>'ver_incidencia_'.$incidencia->id,'class'=> 'modal-btn fa fa-eye text-info icono-tabla-fa']); ?>
                            <?= $this->Html->link('', ['controller' => 'Incidencias', 'action' => 'edit', $incidencia->id],['class'=> 'fa fa-edit text-primary icono-tabla-fa']); ?>
                            <?= $this->Form->postLink('', ['controller' => 'Incidencias', 'action' => 'delete', $incidencia->id], ['class'=> 'fa fa-trash text-danger icono-fa','confirm' => __('Estás seguro de que quieres borrar a # {0}?', $participantes->nombre.' '.$participantes->apellidos)]); ?>
                          
                        </div>
                        <div class="message_wrapper">
                          <h4 class="heading"><?= $incidencia->incidenciatipo->tipo;?></h4>
                          <blockquote class="message"><?= $incidencia->descripcion;?></blockquote>
                          <br>

                        </div>
                    </li> 
                    -->

                    <li>
                         
                      <div class="block">

                        <div class="tags">
                          <a  class= "tag">
                            <span><strong><?= $this->Time->format($incidencia->fecha, "dd/MM/yyyy", null); ?></strong></span>
                          </a>
                          <?= $this->Html->image('user_fotos/'.$incidencia->user->foto, ['class'=> 'avatar']); ?>
                        </div>
                        <div class="block_content">
                            
                          <h2 class="title">
                                          <a><?= $incidencia->incidenciatipo->tipo;?></a>
                                      </h2>
                          <div class="byline">
                             Creado por <a><?= $incidencia->user->nombre.' '.$incidencia->user->apellidos;?></a>
                          </div>
                          <p class="excerpt">
                                <?= substr($incidencia->descripcion,0,200);?>
                          <a href="#" id = "ver_incidencia_<?=$incidencia->id; ?>" class= "modal-btn"><strong>... Leer&nbsp;más</strong></a>
                          </p>
                        </div>
                      </div>
                    </li>

                    <!-- Modal -->

                    <div id="modal_ver_incidencia_<?= $incidencia->id;?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel"><strong>Expediente: <?= $expediente['numedis']?></strong>.</h4>
                                     
                                     <h4 class="modal-title label label-warning"><strong ><?= $incidencia->incidenciatipo->tipo; ?></strong>.</h4>
                                    <span class="label label-success pull-right"><big><?= $this->Time->format($incidencia->fecha, "dd/MM/yyyy", null); ?></big></span>
                                    <p></p>
                                    <p>Incidencia registrada por: <?= $incidencia->user->nombre.' '.$incidencia->user->apellidos; ?></p>
                                </div>
                                <div class="modal-body">
                                     
                                    
                                    <blockquote><?= $incidencia->descripcion; ?></blockquote>

                                </div>

                                <div class="modal-footer">

                                    <?php if ($incidencia->user->id === $auth['id']): ?>
                                         <?= $this->Html->link('', ['controller' => 'Incidencias', 'action' => 'edit', $incidencia->id],['class'=> 'fa fa-edit text-primary icono-tabla-fa']); ?>
                                        
                                        <?= $this->Form->postLink('', ['controller' => 'Incidencias', 'action' => 'delete', $incidencia->id], ['class'=> 'fa fa-trash text-danger icono-fa','confirm' => __('¿Estás seguro de que quieres borrar esta incidencia?')]); ?>
                                    <?php endif ?>

                                       

                                </div>   

                            </div>
                        </div>
                    </div>

                <?php endforeach ?>

            </ul>

        </div>
    </div>
</div>



<!--*****************************************************************************************************************-->


<!--Modal ADD PARTICIPANTE--> 

<div id="modal_add_participante" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Añade un nuevo miembro a la parrilla del expediente <strong><?= $expediente['numedis']?></strong></h4>
            </div>
            <div class="modal-body">
                <?= $this->Form->create($participante,['class'=>'form-horizontal form-label-left data-parsley-validate=""']) ?>

                <div class="form-group has-feedback">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">DNI/NIE <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php
                            echo $this->Form->input('participantes.dni', [
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
                            echo $this->Form->input('participantes.nombre', [
                                    'class'=>'form-control col-md-7 col-xs-12',
                                    //'required' => 'required',
                                    'label' => ['text' => '']
                                ]);
                        ?> 
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Apellidos <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php
                            echo $this->Form->input('participantes.apellidos', [
                                    'class'=>'form-control col-md-7 col-xs-12',
                                    'required' => 'required',
                                    'label' => ['text' => '']
                                ]);
                        ?> 
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Sexo <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php 

                             echo $this->Form->imput(
                                        'participantes.sexo',
                                        [
                                            'type' => 'radio',
                                            'options'=>[
                                                ['value' => 'M', 'text' => 'Hombre', 'style' => 'color:red;',
                                                ],
                                                ['value' => 'F', 'text' => 'Mujer', 'style' => 'color:yellow;',
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

                <div class="form-group has-feedback">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Relación con el Titular de la HS <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php
                            echo $this->Form->input('participantes.relation_id', [
                                                            'type' => 'select',
                                                            'class'=>'form-control col-md-7 col-xs-12',
                                                            'default' => '',
                                                            'required' => 'required',
                                                            'label' => ['text' => ''],
                                                            'options' => $listado_relaciones,
                                                            'empty'   => 'Selecciona una relación con el titular...'
                                                        ]);
                        ?> 
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha de Nacimiento </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php

                            echo $this->Form->input('participantes.nacimiento', [
                                    'type'=>'text',
                                    //'dateFormat' => 'DMY',
                                    'class'=>'datepicker form-control col-md-7 col-xs-12',
                                    //'required' => 'required',
                                    'label' => ['text' => ''],
                                    'placeholder' => '_ _ / _ _ / _ _ _ _'
                                    //'templates'=>['dateWidget' => '{{day}}{{month}}{{year}}']
                                ]);
                        ?> 
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Correo Electrónico </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php
                            echo $this->Form->input('participantes.email', [
                                    'class'=>'form-control col-md-7 col-xs-12',
                                    //'required' => 'required',
                                    'label' => ['text' => '']
                                ]);
                        ?> 
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Teléfono </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php
                            echo $this->Form->input('participantes.telefono', [
                                    'class'=>'form-control col-md-7 col-xs-12',
                                    //'required' => 'required',
                                    'label' => ['text' => '']
                                ]);
                        ?> 
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Observaciones sobre este USUARIO </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php
                            echo $this->Form->input('participantes.observaciones', [
                                    'class'=>'editor form-control col-md-7 col-xs-12',
                                    //'required' => 'required',
                                    'label' => ['text' => '']
                                ]);
                        ?> 
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <?= $this->Form->button('Añadir el Nuevo Usuario ->', ['class' => 'btn btn-success']) ?>
                <?= $this->Html->link('Cerrar', ['action'=>'index'],['class' => 'btn btn-primary','data-dismiss'=>"modal"]) ?>
                
            </div>
               
                <?= $this->Form->end() ?>
        </div>
    </div>
</div>


<!--Modal ADD FECHA DE NACIMIENTO--> 

<?php foreach ($expediente->participantes as $participantes): ?> 

    <div id="modal_add_fecha_nacimiento_<?= $participantes->id;?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Añade la fecha de nacimiento de <strong><?= $participantes['nombre'].' '.$participantes['apellidos']?></strong></h4>
            </div>
            <div class="modal-body">
                
                <?= $this->Form->create($participante,[
                                            'url' => ['controller' => 'Participantes', 'action' => 'edit_nacimiento', $participantes['id']], 
                                            'class'=>'form-horizontal form-label-left data-parsley-validate=""'
                                            ]); ?>


                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha de Nacimiento <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php

                            echo $this->Form->input('nacimiento', [
                                    'type'=>'text',
                                    //'dateFormat' => 'DMY',
                                    'class'=>'datepicker form-control col-md-7 col-xs-12',
                                    //'required' => 'required',
                                    'label' => ['text' => ''],
                                    'placeholder' => '_ _ / _ _ / _ _ _ _'
                                    //'templates'=>['dateWidget' => '{{day}}{{month}}{{year}}']
                                ]);
                        ?> 
                    </div>
                </div>
 
            </div>
            <div class="modal-footer">
                <?= $this->Form->button('Guardar cambios ->', ['class' => 'btn btn-success']) ?>
                <?= $this->Html->link('Cerrar', ['action'=>'index'],['class' => 'btn btn-primary','data-dismiss'=>"modal"]) ?>
                
            </div>
               
                <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<?php endforeach ?>

<!--Modal ADD INCIDENCIA--> 

    <div id="modal_add_incidencia" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Añade una nueva incidencia para el expediente <strong><?= $expediente['numedis']?></strong></h4>
            </div>
            <div class="modal-body">
                
                <?= $this->Form->create($nueva_incidencia,['class'=>'form-horizontal form-label-left data-parsley-validate=""']) ?>
     
                         <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <?php

                                    echo $this->Form->input('incidencias.fecha', [
                                            'type'=>'text',
                                            'default' => date('d/m/Y'),
                                            'dateFormat' => 'DMY',
                                            'class'=>'datepicker form-control col-md-7 col-xs-12',
                                            //'required' => 'required',
                                            'label' => ['text' => ''],
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
                                    echo $this->Form->input('incidencias.incidenciatipo_id', [
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
                                    echo $this->Form->input('incidencias.descripcion', [
                                        'class'=>'editor form-control col-md-7 col-xs-12',
                                        //'required' => 'required',
                                        'label' => ['text' => '']
                                    ]);
                                ?> 
                            </div>
                        </div>

                        <?= $this->Form->input('incidencias.expediente_id', ['type'=>'hidden', 'value'=>$expediente['id']]);?>
                        <?= $this->Form->input('incidencias.user_id', ['type'=>'hidden', 'value'=>$auth['id']]);?>

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
