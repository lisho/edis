
<h1>Usuarios</h1>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Lista completa de los Usuaruos registrados en el sistema </h2>
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

        <table id="datatable" class="table table-striped table-bordered" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    
                    <th>DNI/NIE</th>
                    <th>Nombre </th>
                    <th>Apellidos </th>
                    <th>Email</th>
                    <th>telefono</th>
                    <th>user</th>
                    <th>password</th>
                    <th>created</th>
                    <th>modified</th>
                    <th>Equipo de Referencia</th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    
                    <td><?= $this->Html->link($user->dni, ['action' => 'view', $user->id]) ?></td>

                    <td><?= h($user->nombre) ?></td>
                    <td><?= h($user->apellidos) ?></td>
                    <td><?= h($user->email) ?></td>
                    <td><?= h($user->telefono) ?></td>
                    <td><?= h($user->user) ?></td>
                    <td><?= h($user->password) ?></td>
                    <td><?= $this->Time->format($user->created, "dd/MM/yyyy HH:mm", null) ?></td>
                    <td><?= $this->Time->format($user->modified, "dd/MM/yyyy HH:mm", null) ?></td>
                     <td><?= $user->has('equipo') ? $this->Html->link($user->equipo->nombre, ['controller' => 'Equipos', 'action' => 'view', $user->equipo->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $user->id], ['class'=> 'btn btn-xs btn-success']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id], ['class'=> 'btn btn-xs btn-info']) ?>
                        <?= $this->Form->postLink(__('delete'), ['action' => 'delete', $user->id], ['class'=> 'btn btn-xs btn-danger', 'confirm' => __('Realmente quieres borrar el registro: # {0}?', $user->nombre)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
<!--
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
            </ul>
            <p><?= $this->Paginator->counter() ?></p>
        </div>
-->

    </div>
</div>


