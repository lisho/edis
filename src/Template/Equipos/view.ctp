<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Equipo'), ['action' => 'edit', $equipo->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Equipo'), ['action' => 'delete', $equipo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $equipo->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Equipos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Equipo'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="equipos view large-9 medium-8 columns content">
    <h3><?= h($equipo->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Nombre') ?></th>
            <td><?= h($equipo->nombre) ?></td>
        </tr>
        <tr>
            <th><?= __('Entidad') ?></th>
            <td><?= h($equipo->entidad) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($equipo->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($equipo->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($equipo->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Tipo') ?></h4>
        <?= $this->Text->autoParagraph(h($equipo->tipo)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Users') ?></h4>
        <?php if (!empty($equipo->users)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Dni') ?></th>
                <th><?= __('Nombre') ?></th>
                <th><?= __('Apellidos') ?></th>
                <th><?= __('Email') ?></th>
                <th><?= __('Telefono') ?></th>
                <th><?= __('User') ?></th>
                <th><?= __('Password') ?></th>
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
                <td><?= h($users->password) ?></td>
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
