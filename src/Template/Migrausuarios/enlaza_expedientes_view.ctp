
<h1>Enlaza Expedientes con Usuarios</h1>


<div class='row'>
    <div class="col-md-12 col-sm-12 col-xs-12"> 
        <div class="x_panel"> 
            <div class="x_title"> 
                <h2>Usuarios Sin Expediente</h2> 
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
             
                <h4><?= 'Usuarios que no pertenecen a ningún Expediente:' ?></h4> 
                
                <table id="desemparejados" class="table table-striped table-bordered datatable" cellpadding="0" cellspacing="0"> 
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
                    <?php foreach ($usuarios as $usuario): ?> 
                        <?php if (!in_array($usuario['numedis'],$expedientes_array)): ?>
                            <tr> 
                                <td><?= h($usuario->id) ?></td> 
                                <td><strong><?= h($usuario->dni) ?></strong></td> 
                                <td><?= h($usuario->nombre) ?></td> 
                                <td><?= h($usuario->apellidos) ?></td> 
                                <td><?= h($usuario->sexo) ?></td> 
                                <td><?= h($usuario->telefono) ?></td> 
                                <td><?= h($usuario->numedis) ?></td> 
                                <td><?= h($usuario->relacion) ?></td> 
                                <td><?= h($usuario->nacimiento) ?></td> 
                                <td><?= h($usuario->nacionalidad) ?></td> 
                                <td><?= h($usuario->observaciones) ?></td> 
                                <td><?= h($usuario->otrosdatos) ?></td> 
                               
                                <td class="actions"> 
                                    <?= $this->Html->link(__('View'), ['controller' => 'Migraexpedientes', 'action' => 'view', $usuario->id]) ?> 
                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Migrausuarios', 'action' => 'edit', $usuario->id]) ?> 
                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Migrausuarios', 'action' => 'delete', $usuario->id], ['confirm' => __('Are you sure you want to delete # {0}?')]) ?> 
                                </td> 
                            </tr> 
                        <?php endif; ?>
                    <?php endforeach; ?> 
                    </tbody>
                </table> 
            </div> 
        </div>
    </div>
</div>

