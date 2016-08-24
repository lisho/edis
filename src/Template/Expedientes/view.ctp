


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
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($expediente->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created  ') ?></th>
                    <td><?= h($expediente->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified  ') ?></th>
                    <td><?= h($expediente->modified) ?></td>
                </tr>
            </table> 
                 
                <br> 
                <?= $this->Html->link(__('Volver'), ['action' => 'index'], ['class'=> 'btn btn-xs btn-primary']) ?> 
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $expediente->id], ['class'=> 'btn btn-xs btn-info']) ?> 
                <?= $this->Form->postLink(__('delete'), ['action' => 'delete', $expediente->id], ['class'=> 'btn btn-xs btn-danger', 'confirm' => __('Realmente quieres borrar el expediente: # {0}?', $expediente->numedis)]) ?> 

        </div> <!--// Fin Panel de datos de expediente-->
    </div>

    <div class="x_panel"> <!--/ Panel de Tecnicos-->
        <div class="x_title"> 
            <big><i class="icono-fa fa fa-list-ul"></i><?= '    Técnicos con roles asociados a este expediente:' ?> </big>
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
                <table id="datatable" class="table table-striped table-bordered" cellpadding="0" cellspacing="0"> 

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
                                <?= $this->Html->link(__('View'), ['controller' => 'Roles', 'action' => 'view', $roles->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Roles', 'action' => 'edit', $roles->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Roles', 'action' => 'delete', $roles->id], ['confirm' => __('Are you sure you want to delete # {0}?', $roles->id)]) ?>
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

<!--Participantes-->

<div class="col-md-8 col-sm-12 col-xs-12"> 
    <div class="x_panel"> 
        <div class="x_title"> 
            <big><i class="icono-fa fa fa-group"></i><?= '  Parrilla Familiar de este expediente:' ?></big> 
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
                <table id="datatable" class="table table-striped table-bordered" cellpadding="0" cellspacing="0"> 
                    <tr> 
                        
                        <th><?= __('Dni') ?></th>
                        <th><?= __('Nombre') ?></th>
                        <th><?= __('Apellidos') ?></th>
                        <th><?= __('Nacimiento') ?></th>
                        <th><?= __('Sexo') ?></th>
                        <th><?= __('Telefono') ?></th>
                        <th><?= __('Email') ?></th>
                        
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr> 
                    <?php foreach ($expediente->participantes as $participantes): ?> 
                    <tr> 
                        
                        <td><?= h($participantes->dni) ?></td>
                        <td><?= h($participantes->nombre) ?></td>
                        <td><?= h($participantes->apellidos) ?></td>
                        <td><?= $this->Time->format($participantes->nacimiento, "dd/MM/yyyy", null) ?></td>
                        <td><?= h($participantes->sexo) ?></td>
                        <td><?= h($participantes->telefono) ?></td>
                        <td><?= h($participantes->email) ?></td>
                        
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'Participantes', 'action' => 'view', $participantes->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Participantes', 'action' => 'edit', $participantes->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Participantes', 'action' => 'delete', $participantes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $participantes->id)]) ?>
                        </td>
                    </tr> 
                    <?php endforeach; ?> 
                </table> 
 
                <?php endif; ?> 
 
            </div> <!--/ FIN Participantes-->
        </div> 
    </div>
</div>







<!--*****************************************************************************************************************-->


<!--Roles--> 

<!--

<div class="col-md-4 col-sm-12 col-xs-12"> 
    <div class="x_panel"> 
        <div class="x_title"> 
            <i class="icono-titulo-fa fa fa-folder-open"></i>Expediente: <big><?= h($expediente->numedis) ?> </big>
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
                <h4><i class="icono-fa fa fa-list-ul"></i><?= '    Técnicos con roles asociados a este expediente:' ?></h4> 
                <?php if (!empty($expediente->roles)): ?> 
                <table id="datatable" class="table table-striped table-bordered" cellpadding="0" cellspacing="0"> 

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
                                <?= $this->Html->link(__('View'), ['controller' => 'Roles', 'action' => 'view', $roles->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Roles', 'action' => 'edit', $roles->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Roles', 'action' => 'delete', $roles->id], ['confirm' => __('Are you sure you want to delete # {0}?', $roles->id)]) ?>
                            </td>      
                        <?php endif; ?>
                        
                    </tr> 
                    <?php endforeach; ?> 
                </table> 
 
                <?php endif; ?> 
 
            </div> --> <!--/ FIN Roles-->
<!--

        </div> 
    </div>
</div>-->


