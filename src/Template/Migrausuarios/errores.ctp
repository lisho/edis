<h1>Control de errores - MIGRACIONES</h1>
<div class='row'>
    <div class="col-md-12 col-sm-12 col-xs-12"> 
        <div class="x_panel"> 
            <div class="x_title"> 
                <h2>Errores Número de DNI / NIE</h2> 
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
             
                <h4><?= 'Número de DNI / NIE incorrectos:'.count($dni_error) ?></h4> 
                
                <table id="error_dni" class="datatable table table-striped table-bordered" cellpadding="0" cellspacing="0"> 
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
                    <?php foreach ($dni_error as $error): ?> 
                        <?php  $marca = ''; ?>
                        <?php if ($error->numedis>4999 && $error->numedis<5999): ?>
                               <?php $marca = 'fila_roja'; ?>    
                        <?php endif; ?>
                    <tr class='<?= $marca;?>'> 
                        <td><?= h($error->id) ?></td> 
                        <td><strong><?= h($error->dni) ?></strong></td> 
                        <td><?= h($error->nombre) ?></td> 
                        <td><?= h($error->apellidos) ?></td> 
                        <td><?= h($error->sexo) ?></td> 
                        <td><?= h($error->telefono) ?></td> 
                        <td><?= h($error->numedis) ?></td> 
                        <td><?= h($error->relacion) ?></td> 
                        <td><?= h($error->nacimiento) ?></td> 
                        <td><?= h($error->nacionalidad) ?></td> 
                        <td><?= h($error->observaciones) ?></td> 
                        <td><?= h($error->otrosdatos) ?></td> 
                       
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
                <h2>Errores Número de DNI / NIE</h2> 
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
             
                <h4><?= 'Número de DNI / NIE incorrectos:'.count($posibles_arraigos) ?></h4> 
                
                <table id="arraigos" class="datatable table table-striped table-bordered" cellpadding="0" cellspacing="0"> 
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
                    <?php foreach ($posibles_arraigos as $error): ?> 
                        <?php  $marca = ''; ?>
                        <?php if ($error->numedis>4999 && $error->numedis<5999): ?>
                               <?php $marca = 'fila_roja'; ?>    
                        <?php endif; ?>
                  
                    <tr class='<?= $marca;?>'> 
                        <td><?= h($error->id) ?></td> 
                        <td><strong><?= h($error->dni) ?></strong></td> 
                        <td><?= h($error->nombre) ?></td> 
                        <td><?= h($error->apellidos) ?></td> 
                        <td><?= h($error->sexo) ?></td> 
                        <td><?= h($error->telefono) ?></td> 
                        <td><?= h($error->numedis) ?></td> 
                        <td><?= h($error->relacion) ?></td> 
                        <td><?= h($error->nacimiento) ?></td> 
                        <td><?= h($error->nacionalidad) ?></td> 
                        <td><?= h($error->observaciones) ?></td> 
                        <td><?= h($error->otrosdatos) ?></td> 
                       
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
                <h2>Errores Número de DNI / NIE</h2> 
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
             
                <h4><?= 'Número de DNI / NIE incorrectos después de quitar los espacios en blanco:'.count($dni_sinespacios) ?></h4> 
                
                <table id="sin_blancos" class="datatable table table-striped table-bordered" cellpadding="0" cellspacing="0"> 
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
                    <?php foreach ($dni_sinespacios as $error): ?> 
                        <?php  $marca = ''; ?>
                        <?php if ($error->numedis>4999 && $error->numedis<5999): ?>
                               <?php $marca = 'fila_roja'; ?>    
                        <?php endif; ?>
                  
                    <tr class='<?= $marca;?>'> 
                        <td><?= h($error->id) ?></td> 
                        <td><strong><?= h($error->dni) ?></strong></td> 
                        <td><?= h($error->nombre) ?></td> 
                        <td><?= h($error->apellidos) ?></td> 
                        <td><?= h($error->sexo) ?></td> 
                        <td><?= h($error->telefono) ?></td> 
                        <td><?= h($error->numedis) ?></td> 
                        <td><?= h($error->relacion) ?></td> 
                        <td><?= h($error->nacimiento) ?></td> 
                        <td><?= h($error->nacionalidad) ?></td> 
                        <td><?= h($error->observaciones) ?></td> 
                        <td><?= h($error->otrosdatos) ?></td> 
                       
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

<!--
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
-->