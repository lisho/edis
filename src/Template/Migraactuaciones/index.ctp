<!--
<div class="migraactuaciones index large-9 medium-8 columns content">
    <h3><?= __('Migraactuaciones') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('id_antiguo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fecha') ?></th>
                <th scope="col"><?= $this->Paginator->sort('dni') ?></th>
                <th scope="col"><?= $this->Paginator->sort('numedis') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nombre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('apellidos') ?></th>
                <th scope="col"><?= $this->Paginator->sort('actuacion') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($migraactuaciones as $migraactuacione): ?>
            <tr>
                <td><?= $this->Number->format($migraactuacione->id) ?></td>
                <td><?= $this->Number->format($migraactuacione->id_antiguo) ?></td>
                <td><?= h($migraactuacione->fecha) ?></td>
                <td><?= h($migraactuacione->dni) ?></td>
                <td><?= h($migraactuacione->numedis) ?></td>
                <td><?= h($migraactuacione->nombre) ?></td>
                <td><?= h($migraactuacione->apellidos) ?></td>
                <td><?= h($migraactuacione->actuacion) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $migraactuacione->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $migraactuacione->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $migraactuacione->id], ['confirm' => __('Are you sure you want to delete # {0}?', $migraactuacione->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>

-->

<h1>Migración de Actuaciones</h1>


<div class='row'>
    <div class="col-md-12 col-sm-12 col-xs-12"> 
        <div class="x_panel"> 
            <div class="x_title"> 
                <h2>Todas las Actuaciones</h2> 
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
             
                <h4><?= 'Listado completo de Actuaciones Enlazadas' ?></h4> 
                
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
                    <?php foreach ($migraactuaciones as $actuacion): ?> 
                    
                            <tr> 
                                <td><?= h($actuacion->id) ?></td> 
                                <td><?= h($actuacion->id_antiguo) ?></td> 
                                <td><?= $this->Time->format($actuacion->fecha, "dd/MM/yyyy", null)?></td> 
                                <td><?= h($actuacion->descripcion) ?></td> 
                                <td><?= h($actuacion->actuacion) ?></td> 
                                <td><?= h($actuacion->expediente_id) ?></td> 
                                <td><?= h($actuacion->numedis) ?></td> 
                               
                               
                                <td class="actions"> <!--
                                    <?= $this->Html->link(__('View'), ['controller' => 'Migraexpedientes', 'action' => 'view', $actuacion['id']]) ?> 
                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Migraexpedientes', 'action' => 'edit', $actuacion['id']]) ?> 
                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Migraexpedientes', 'action' => 'delete', $actuacion['id']], ['confirm' => __('Are you sure you want to delete # {0}?')]) ?> 
                                --></td> 
                            </tr> 

                    <?php endforeach; ?> 
                    </tbody>
                </table> 
            </div> 
        </div>
    </div>
</div>

