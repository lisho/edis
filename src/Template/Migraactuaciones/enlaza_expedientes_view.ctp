
<h1>Enlaza Expedientes con Actuaciones</h1>


<div class='row'>
    <div class="col-md-12 col-sm-12 col-xs-12"> 
        <div class="x_panel"> 
            <div class="x_title"> 
                <h2>Actuaciones Sin Expediente</h2> 
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
             
                <h4><?= 'Actuaciones que no pertenecen a ningún Expediente:' ?></h4> 
                
                <table id="desemparejados" class="table table-striped table-bordered datatable" cellpadding="0" cellspacing="0"> 
                    <thead>
                    <tr> 
                        <th><?= __('Id') ?></th> 
                        <th><?= __('id_antiguo') ?></th> 
                        <th><?= __('fecha') ?></th> 
                        <th><?= __('descripción') ?></th> 
                        <th><?= __('actuación') ?></th> 
                        <th><?= __('expediente_id') ?></th> 
                        <th><?= __('Exp- EDIS') ?></th> 
                        
                        <th></th>
                    </tr> 
                    </thead>

                    <tbody>
                    <?php foreach ($actuaciones as $actuacion): ?> 
                        <?php if (!in_array($actuacion['numedis'],$expedientes_array)): ?>
                            <tr> 
                                <td><?= h($actuacion->id) ?></td> 
                                <td><?= h($actuacion->id_antiguo) ?></td> 
                                <td><?= $this->Time->format($actuacion->fecha, "dd/MM/yyyy", null)?></td> 
                                <td><?= h($actuacion->descripcion) ?></td> 
                                <td><?= h($actuacion->actuacion) ?></td> 
                                <td><?= h($actuacion->expediente_id) ?></td> 
                                <td><?= h($actuacion->numedis) ?></td> 
                               
                               
                                <td class="actions"> <!--
                                    <?= $this->Html->link(__('View'), ['controller' => 'Migraexpedientes', 'action' => 'view', $error['id']]) ?> 
                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Migraexpedientes', 'action' => 'edit', $error['id']]) ?> 
                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Migraexpedientes', 'action' => 'delete', $error['id']], ['confirm' => __('Are you sure you want to delete # {0}?')]) ?> 
                                --></td> 
                            </tr> 
                        <?php endif; ?>
                    <?php endforeach; ?> 
                    </tbody>
                </table> 
            </div> 
        </div>
    </div>
</div>

