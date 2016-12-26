<div class="col-md-12 col-sm-12 col-xs-12"> 
    <div class="x_panel"> 
        <div class="x_title"> 
            <h2>Equipo:<small><?= h($equipo->nombre) ?> </small></h2> 
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
         
            <div class="row"> 
                <h4><small><?= __('Tipo:') ?> </small> <?= h($equipo->tipo); ?></h4>        
            </div>         
 
            <table class="vertical-table"> 
                 
                <tr> 
                    <th><?= __('Id:  ') ?></th> 
                    <td><?= $this->Number->format($equipo->id) ?></td> 
                </tr> 
                <tr> 
                    <th><?= __('Nombre:  ') ?></th> 
                    <td><?= h($equipo->nombre) ?></td> 
                </tr> 
                <tr> 
                    <th><?= __('Entidad:  ') ?></th> 
                    <td><?= h($equipo->entidad) ?></td> 
                </tr>        
                <tr> 
                    <th><?= __('Created:  ') ?></th> 
                    <td><?= h($equipo->created) ?></td> 
                </tr> 
                <tr> 
                    <th><?= __('Modified:  ') ?></th> 
                    <td><?= h($equipo->modified) ?></td> 
                </tr> 
            </table> 
                 
                <br> 
                <?= $this->Html->link(__('Volver'), ['action' => 'index'], ['class'=> 'btn btn-xs btn-primary']) ?> 
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $equipo->id], ['class'=> 'btn btn-xs btn-info']) ?> 
                <?= $this->Form->postLink(__('delete'), ['action' => 'delete', $equipo->id], ['class'=> 'btn btn-xs btn-danger', 'confirm' => __('Realmente quieres borrar el registro: # {0}?', $equipo->nombre)]) ?> 
 
            <div class="related"> 
                <h4><?= 'Miembros de este Equipo:' ?></h4> 
                <?php if (!empty($equipo->users)): ?> 
                <table id="datatable" class="table table-striped table-bordered" cellpadding="0" cellspacing="0"> 
                    <tr> 
                        <th><?= __('Id') ?></th> 
                        <th><?= __('Dni') ?></th> 
                        <th><?= __('Nombre') ?></th> 
                        <th><?= __('Apellidos') ?></th> 
                        <th><?= __('Email') ?></th> 
                        <th><?= __('Telefono') ?></th> 
                        <th><?= __('User') ?></th> 
                        <!-- <th><?= __('Password') ?></th> -->
                        <th><?= __('Role') ?></th> 
                        <th><?= __('Created') ?></th> 
                        <th><?= __('Modified') ?></th> 
                        <th><?= __('Equipo Id') ?></th> 
                        <th class="actions"><?= __('Actions') ?></th> 
                    </tr> 
                    <?php foreach ($equipo->users as $users): ?> 
                    <tr> 
                        <td><?= h($users->id) ?></td> 
                        <td><?= h($users->dni) ?></td> 
                        <td><?= h($users->nombre) ?></td> 
                        <td><?= h($users->apellidos) ?></td> 
                        <td><?= h($users->email) ?></td> 
                        <td><?= h($users->telefono) ?></td> 
                        <td><?= h($users->user) ?></td> 
                        <!-- <td><?= h($users->password) ?></td> -->
                        <td><?= h($users->role) ?></td> 
                        <td><?= h($users->created) ?></td> 
                        <td><?= h($users->modified) ?></td> 
                        <td><?= h($users->equipo_id) ?></td> 
                        <td class="actions"> 
                            <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?> 
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?> 
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) ?> 
                        </td> 
                    </tr> 
                    <?php endforeach; ?> 
                </table> 
 
                <?php endif; ?> 
 
            </div> 
        </div> 
    </div>
</div>