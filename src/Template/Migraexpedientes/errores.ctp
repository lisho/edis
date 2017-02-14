<h1>Control de errores - MIGRAEXPEDIENTES</h1>
<div class='row'>
    <div class="col-md-12 col-sm-12 col-xs-12"> 
        <div class="x_panel"> 
            <div class="x_title"> 
                <h2>Errores Número de expediente EDIS</h2> 
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
             
                <h4><?= 'Expedientes con algún error en el número de expediente:' ?></h4> 
                
                <table id="datatable" class="table table-striped table-bordered" cellpadding="0" cellspacing="0"> 
                    <tr> 
                        <th><?= __('Id') ?></th> 
                        <th><?= __('numedis') ?></th> 
                        <th><?= __('TEDIS') ?></th> 
                        <th><?= __('C. Caso') ?></th> 
                        <th><?= __('RGC') ?></th> 
                        <th><?= __('CEAS') ?></th> 
                        <th><?= __('F. Alta') ?></th> 
                        <th><?= __('F. Baja') ?></th> 
                        <th><?= __('Domicilio') ?></th> 
                        <th></th>
                    </tr> 
                    <?php if (isset($numedis_error)): ?>
                        <?php foreach ($numedis_error as $error): ?> 
                          <tr> 
                              <td><?= h($error->id) ?></td> 
                              <td><strong><?= h($error->numedis) ?></strong></td> 
                              <td><?= h($error->tedis) ?></td> 
                              <td><?= h($error->cc) ?></td> 
                              <td><?= h($error->rgc) ?></td> 
                              <td><?= h($error->ceas) ?></td> 
                              <td><?= h($error->alta) ?></td> 
                              <td><?= h($error->baja) ?></td> 
                              <td><?= h($error->domicilio) ?></td> 
                             
                              <td class="actions"> 
                                  <?= $this->Html->link(__('View'), ['controller' => 'Migraexpedientes', 'action' => 'view', $error['id']]) ?> 
                                  <?= $this->Html->link(__('Edit'), ['controller' => 'Migraexpedientes', 'action' => 'edit', $error['id']]) ?> 
                                  <?= $this->Form->postLink(__('Delete'), ['controller' => 'Migraexpedientes', 'action' => 'delete', $error['id']], ['confirm' => __('Are you sure you want to delete # {0}?')]) ?> 
                              </td> 
                          </tr> 
                        <?php endforeach; ?>    
                    <?php endif; ?>
                    
                </table> 
            </div> 
        </div>
    </div>
</div>

<div class='row'>
    <div class="col-md-12 col-sm-12 col-xs-12"> 
        <div class="x_panel"> 
            <div class="x_title"> 
                <h2>Posibles Expedientes de Arraigo</h2> 
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
             
                <h4><?= 'Expedientes de arraigo (4999-5999): '.count($posibles_arraigos) ?></h4> 
                
                <table id="datatable" class="table table-striped table-bordered" cellpadding="0" cellspacing="0"> 
                    <tr> 
                        <th><?= __('Id') ?></th> 
                        <th><?= __('numedis') ?></th> 
                        <th><?= __('TEDIS') ?></th> 
                        <th>Parrilla</th>
                        <th><?= __('C. Caso') ?></th> 
                        <th><?= __('RGC') ?></th> 
                        <th><?= __('CEAS') ?></th> 
                        <th><?= __('F. Alta') ?></th> 
                        <th><?= __('F. Baja') ?></th> 
                        <th><?= __('Domicilio') ?></th> 
                        <th></th>
                    </tr> 
                    <?php if (isset($posibles_arraigos)): ?>
                        <?php foreach ($posibles_arraigos as $error): ?> 
                          <tr> 
                              <td><?= h($error->id) ?></td> 
                              <td><strong><?= h($error->numedis) ?></strong></td> 
                              <td><?= h($error->tedis) ?></td>
                              <td><?= count($error->migraexpedientes)?></td>
                              <td><?= h($error->cc) ?></td> 
                              <td><?= h($error->rgc) ?></td> 
                              <td><?= h($error->ceas) ?></td> 
                              <td><?= h($error->alta) ?></td> 
                              <td><?= h($error->baja) ?></td> 
                              <td><?= h($error->domicilio) ?></td> 
                             
                              <td class="actions"> 
                                  <?= $this->Html->link(__('View'), ['controller' => 'Migraexpedientes', 'action' => 'view', $error['id']]) ?> 
                                  <?= $this->Html->link(__('Edit'), ['controller' => 'Migraexpedientes', 'action' => 'edit', $error['id']]) ?> 
                                  <?= $this->Form->postLink(__('Delete'), ['controller' => 'Migraexpedientes', 'action' => 'delete', $error['id']], ['confirm' => __('Are you sure you want to delete # {0}?')]) ?> 
                              </td> 
                          </tr> 
                        <?php endforeach; ?>    
                    <?php endif; ?>
                    
                </table> 
            </div> 
        </div>
    </div>
</div>
<div class='row'>    
    <div class="col-md-4 col-sm-4 col-xs-12"> 
        <div class="x_panel"> 
            <div class="x_title"> 
                <h2>Numero de Expedientes TOTAL por Asignación</h2> 
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
             
                    <h4><?= 'Expedientes por Asignación:' ?></h4> 
                        <ul>
                    <?php foreach ($tedis as $k=>$t): ?> 
                            <?php $k = ($k)?:'No Asignado'; ?>
                            <li><?= $k.' : '.$t['val'];?></li>               
                    <?php endforeach; ?> 
                        </ul>
                </div> 
            </div> 
        </div>
    </div>
</div>