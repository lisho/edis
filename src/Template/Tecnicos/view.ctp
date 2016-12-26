<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Tecnico'), ['action' => 'edit', $tecnico->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Tecnico'), ['action' => 'delete', $tecnico->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tecnico->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Tecnicos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tecnico'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Equipos'), ['controller' => 'Equipos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Equipo'), ['controller' => 'Equipos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tecnicos view large-9 medium-8 columns content">
    <h3><?= h($tecnico->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Nombre') ?></th>
            <td><?= h($tecnico->nombre) ?></td>
        </tr>
        <tr>
            <th><?= __('Apellidos') ?></th>
            <td><?= h($tecnico->apellidos) ?></td>
        </tr>
        <tr>
            <th><?= __('Equipo') ?></th>
            <td><?= $tecnico->has('equipo') ? $this->Html->link($tecnico->equipo->nombre, ['controller' => 'Equipos', 'action' => 'view', $tecnico->equipo->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Puesto') ?></th>
            <td><?= h($tecnico->puesto) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($tecnico->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Roles') ?></h4>
        <?php if (!empty($tecnico->roles)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Expediente Id') ?></th>
                <th><?= __('Tecnico Id') ?></th>
                <th><?= __('Rol') ?></th>
                <th><?= __('Observaciones') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($tecnico->roles as $roles): ?>
            <tr>
                <td><?= h($roles->id) ?></td>
                <td><?= h($roles->expediente_id) ?></td>
                <td><?= h($roles->tecnico_id) ?></td>
                <td><?= h($roles->rol) ?></td>
                <td><?= h($roles->observaciones) ?></td>
                <td><?= h($roles->created) ?></td>
                <td><?= h($roles->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Roles', 'action' => 'view', $roles->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Roles', 'action' => 'edit', $roles->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Roles', 'action' => 'delete', $roles->id], ['confirm' => __('Are you sure you want to delete # {0}?', $roles->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
