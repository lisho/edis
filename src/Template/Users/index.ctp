
<h1>Usuarios</h1>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Lista completa de los Usuaruos registrados en el sistema </h2>
        
        <?= $this->Element('menus/menu_panel');?>

        <div class="clearfix"></div>
      </div>


      <div class="x_content">

        <table id="datatable" class="table table-striped table-bordered" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th></th>
                    <th>DNI/NIE</th>
                    <th>Nombre </th>
                    <th>Apellidos </th>
                    <th>Email</th>
                    <th>telefono</th>
                    <th>user</th>
                    <th>role</th>
                    <th>foto</th>
                    <th>created</th>
                    <th>modified</th>
                    <th>Equipo de Referencia</th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    
                    <td>
                        <div class="img-contenedor text-center">
                          <?php if ($user['foto']!=''): ?>
                            <img class="img-circle avatar" src="img/user_fotos/<?= $user['foto']; ?>" width="100%"></img>
                          <?php else: ?>
                            <i class="fa fa-user fa-5x"></i>
                          <?php endif; ?>

                        </div>

                    </td>

                    <td><?= $this->Html->link($user->dni, ['action' => 'view', $user->id]) ?></td>

                    <td><?= h($user->nombre) ?></td>
                    <td><?= h($user->apellidos) ?></td>
                    <td><?= h($user->email) ?></td>
                    <td><?= h($user->telefono) ?></td>
                    <td><?= h($user->user) ?></td>
                    <td><?= h($user->role) ?></td>
                    <td><?= h($user->foto) ?></td>
                    <td><?= $this->Time->format($user->created, "dd/MM/yyyy", null) ?></td>
                    <td><?= $this->Time->format($user->modified, "dd/MM/yyyy", null) ?></td>
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


