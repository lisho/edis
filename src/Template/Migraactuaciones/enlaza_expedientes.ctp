
<h1>Enlaza Expedientes con Usuarios</h1>


<div class='row'>
    <div class="col-md-12 col-sm-12 col-xs-12"> 
        <div class="x_panel"> 
            <div class="x_title"> 
                <h2>Usuarios enlazados correctamente</h2> 
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
             
                <h4><?= 'Número usuarios emparejados correctamente:'.count($listado_emparejados) ?></h4> 
                
                <table id="emparejados" class="table-striped table-bordered datatable" cellpadding="0" cellspacing="0"> 
                    <thead>
                    <tr> 
                        <th><?= __('Id') ?></th> 
                        <th><?= __('DNI') ?></th> 
                        <th><?= __('Nombre') ?></th> 
                        <th><?= __('Apellidos') ?></th> 
                        <th><?= __('Sexo') ?></th> 
                        <th><?= __('Telefono') ?></th> 
                        <th><?= __('Exp- EDIS') ?></th> 
                        <th><?= __('Relación') ?></th> 
                        <th><?= __('F. Nacimiento') ?></th> 
                        <th><?= __('Nacionalidad') ?></th> 
                        <th><?= __('Observaciones') ?></th> 
                        <th><?= __('Otros Datos') ?></th> 
                        <th></th>
                    </tr> 
                    </thead>
                    <tbody>
                    <?php foreach ($listado_emparejados as $par): ?> 
                        <?php  $marca = ''; ?>
                        <?php if ($par->numedis>4999 && $par->numedis<5999): ?>
                               <?php $marca = 'fila_roja'; ?>    
                        <?php endif; ?>
                    <tr class='<?= $marca;?>'> 
                        <td><?= h($par->id) ?></td> 
                        <td><strong><?= h($par->dni) ?></strong></td> 
                        <td><?= h($par->nombre) ?></td> 
                        <td><?= h($par->apellidos) ?></td> 
                        <td><?= h($par->sexo) ?></td> 
                        <td><?= h($par->telefono) ?></td> 
                        <td><?= h($par->numedis) ?></td> 
                        <td><?= h($par->relacion) ?></td> 
                        <td><?= h($par->nacimiento) ?></td> 
                        <td><?= h($par->nacionalidad) ?></td> 
                        <td><?= h($par->observaciones) ?></td> 
                        <td><?= h($par->otrosdatos) ?></td> 
                       
                        <td class="actions"> <!--
                            <?= $this->Html->link(__('View'), ['controller' => 'Migraexpedientes', 'action' => 'view', $error['id']]) ?> 
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Migraexpedientes', 'action' => 'edit', $error['id']]) ?> 
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Migraexpedientes', 'action' => 'delete', $error['id']], ['confirm' => __('Are you sure you want to delete # {0}?')]) ?> 
                        --></td> 
                    </tr> 
                    <?php endforeach; ?> 
                    </tbody>
                </table> 
            </div> 
        </div>
    </div>
</div>


<div class='row'>
    <div class="col-md-12 col-sm-12 col-xs-12"> 
        <div class="x_panel"> 
            <div class="x_title"> 
                <h2>Usuarios enlazados correctamente</h2> 
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
             
                <h4><?= 'Número usuarios con numedis no encontrado:'.count($listado_no_encontrados) ?></h4> 
                
                <table id="no_encontrados" class="table-striped table-bordered datatable" cellpadding="0" cellspacing="0"> 
                    <thead>
                    <tr> 
                        <th><?= __('Id') ?></th> 
                        <th><?= __('DNI') ?></th> 
                        <th><?= __('Nombre') ?></th> 
                        <th><?= __('Apellidos') ?></th> 
                        <th><?= __('Sexo') ?></th> 
                        <th><?= __('Telefono') ?></th> 
                        <th><?= __('Exp- EDIS') ?></th> 
                        <th><?= __('Relación') ?></th> 
                        <th><?= __('F. Nacimiento') ?></th> 
                        <th><?= __('Nacionalidad') ?></th> 
                        <th><?= __('Observaciones') ?></th> 
                        <th><?= __('Otros Datos') ?></th> 
                        <th></th>
                    </tr> 
                    </thead>
                    <tbody>
                    <?php foreach ($listado_no_encontrados as $par): ?> 
                        <?php  $marca = ''; ?>
                        <?php if ($par->numedis>4999 && $par->numedis<5999): ?>
                               <?php $marca = 'fila_roja'; ?>    
                        <?php endif; ?>
                    <tr class='<?= $marca;?>'> 
                        <td><?= h($par->id) ?></td> 
                        <td><strong><?= h($par->dni) ?></strong></td> 
                        <td><?= h($par->nombre) ?></td> 
                        <td><?= h($par->apellidos) ?></td> 
                        <td><?= h($par->sexo) ?></td> 
                        <td><?= h($par->telefono) ?></td> 
                        <td><?= h($par->numedis) ?></td> 
                        <td><?= h($par->relacion) ?></td> 
                        <td><?= h($par->nacimiento) ?></td> 
                        <td><?= h($par->nacionalidad) ?></td> 
                        <td><?= h($par->observaciones) ?></td> 
                        <td><?= h($par->otrosdatos) ?></td> 
                       
                        <td class="actions"> <!--
                            <?= $this->Html->link(__('View'), ['controller' => 'Migraexpedientes', 'action' => 'view', $error['id']]) ?> 
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Migraexpedientes', 'action' => 'edit', $error['id']]) ?> 
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Migraexpedientes', 'action' => 'delete', $error['id']], ['confirm' => __('Are you sure you want to delete # {0}?')]) ?> 
                        --></td> 

                    </tr> 
                    <?php endforeach; ?> 
                    </tebody>
                </table> 
            </div> 
        </div>
    </div>
</div>

<div class='row'>
    <div class="col-md-12 col-sm-12 col-xs-12"> 
        <div class="x_panel"> 
            <div class="x_title"> 
                <h2>Usuarios enlazados correctamente</h2> 
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
             
                <h4><?= 'Número usuarios emparejados correctamente pero con error al gravar en la BASE:'.count($listado_errores_save) ?></h4> 
                
                <table id="errores_save" class="table-striped table-bordered datatable" cellpadding="0" cellspacing="0"> 
                    <thead>
                    <tr> 
                        <th><?= __('Id') ?></th> 
                        <th><?= __('DNI') ?></th> 
                        <th><?= __('Nombre') ?></th> 
                        <th><?= __('Apellidos') ?></th> 
                        <th><?= __('Sexo') ?></th> 
                        <th><?= __('Telefono') ?></th> 
                        <th><?= __('Exp- EDIS') ?></th> 
                        <th><?= __('Relación') ?></th> 
                        <th><?= __('F. Nacimiento') ?></th> 
                        <th><?= __('Nacionalidad') ?></th> 
                        <th><?= __('Observaciones') ?></th> 
                        <th><?= __('Otros Datos') ?></th> 
                        <th></th>
                    </tr> 
                    </thead>
                    <<tbody>
                    <?php foreach ($listado_errores_save as $par): ?> 
                        <?php  $marca = ''; ?>
                        <?php if ($par->numedis>4999 && $par->numedis<=5999): ?>
                               <?php $marca = 'fila_roja'; ?>    
                        <?php endif; ?>
                    <tr class='<?= $marca;?>'> 
                        <td><?= h($par->id) ?></td> 
                        <td><strong><?= h($par->dni) ?></strong></td> 
                        <td><?= h($par->nombre) ?></td> 
                        <td><?= h($par->apellidos) ?></td> 
                        <td><?= h($par->sexo) ?></td> 
                        <td><?= h($par->telefono) ?></td> 
                        <td><?= h($par->numedis) ?></td> 
                        <td><?= h($par->relacion) ?></td> 
                        <td><?= h($par->nacimiento) ?></td> 
                        <td><?= h($par->nacionalidad) ?></td> 
                        <td><?= h($par->observaciones) ?></td> 
                        <td><?= h($par->otrosdatos) ?></td> 
                       
                        <td class="actions"> <!--
                            <?= $this->Html->link(__('View'), ['controller' => 'Migraexpedientes', 'action' => 'view', $error['id']]) ?> 
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Migraexpedientes', 'action' => 'edit', $error['id']]) ?> 
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Migraexpedientes', 'action' => 'delete', $error['id']], ['confirm' => __('Are you sure you want to delete # {0}?')]) ?> 
                        --></td> 
                    </tr> 
                    <?php endforeach; ?>
                    </tbody> 
                </table> 
            </div> 
        </div>
    </div>
</div>
