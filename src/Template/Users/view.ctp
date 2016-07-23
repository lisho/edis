<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Usuario:<small><?= h($user->nombre.' '.$user->apellidos) ?> </small></h2>
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
                       
            </div>        
            
            <div class="col-md-3 col-sm-3 col-xs-12 profile_left">

                <div class="profile_img">

                    <!-- end of image cropping -->
                    <div id="crop-avatar">
                      <!-- Current avatar -->
                        <?php if ($user['foto']!=''): ?>
                            <?= $this->Html->image('user_fotos/'.$user['foto'], ['class'=>'', 'width'=>'100%'])?>
                            
                          <?php else: ?>
                            <i class="fa fa-user fa-5x"></i>
                          <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-md-9 col-sm-9 col-xs-12">
                <table class="vertical-table">
                    <tr>
                        <th><?= __('Dni') ?></th>
                        <td><?= h($user->dni) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Nombre') ?></th>
                        <td><?= h($user->nombre) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Apellidos') ?></th>
                        <td><?= h($user->apellidos) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Email') ?></th>
                        <td><?= h($user->email) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Telefono') ?></th>
                        <td><?= h($user->telefono) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('User') ?></th>
                        <td><?= h($user->user) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Password   ') ?></th>
                        <td><?= h($user->password) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Equipo') ?></th>
                        <td><?= $user->has('equipo') ? $this->Html->link($user->equipo->id, ['controller' => 'Equipos', 'action' => 'view', $user->equipo->id]) : '' ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Id') ?></th>
                        <td><?= $this->Number->format($user->id) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Created') ?></th>
                        <td><?= h($user->created) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Modified') ?></th>
                        <td><?= h($user->modified) ?></td>
                    </tr>
                </table>
            </div>
            <div class="row">
                <h4><?= __('Role') ?></h4>
                <?= $this->Text->autoParagraph(h($user->role)); ?>
            </div>

            <br>
            
            <?= $this->Html->link(__('Volver'), ['action' => 'index'], ['class'=> 'btn btn-xs btn-primary']) ?>
            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id], ['class'=> 'btn btn-xs btn-info']) ?>
            <?= $this->Form->postLink(__('delete'), ['action' => 'delete', $user->id], ['class'=> 'btn btn-xs btn-danger', 'confirm' => __('Realmente quieres borrar el registro: # {0}?', $user->nombre.' '.$user->apellidos)]) ?>
        </div>
    </div>
</div>
