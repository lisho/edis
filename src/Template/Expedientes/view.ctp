<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Expediente'), ['action' => 'edit', $expediente->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Expediente'), ['action' => 'delete', $expediente->id], ['confirm' => __('Are you sure you want to delete # {0}?', $expediente->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Expedientes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Expediente'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Participantes'), ['controller' => 'Participantes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Participante'), ['controller' => 'Participantes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="expedientes view large-9 medium-8 columns content">
    <h3><?= h($expediente->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Numedis') ?></th>
            <td><?= h($expediente->numedis) ?></td>
        </tr>
        <tr>
            <th><?= __('numhs') ?></th>
            <td><?= h($expediente->numhs) ?></td>
        </tr>
        <tr>
            <th><?= __('Domicilio') ?></th>
            <td><?= h($expediente->domicilio) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($expediente->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($expediente->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($expediente->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Participantes') ?></h4>
        <?php if (!empty($expediente->participantes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Dni') ?></th>
                <th><?= __('Nombre') ?></th>
                <th><?= __('Apellidos') ?></th>
                <th><?= __('Nacimiento') ?></th>
                <th><?= __('Sexo') ?></th>
                <th><?= __('Telefono') ?></th>
                <th><?= __('Email') ?></th>
                <th><?= __('Expediente Id') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($expediente->participantes as $participantes): ?>
            <tr>
                <td><?= h($participantes->id) ?></td>
                <td><?= h($participantes->dni) ?></td>
                <td><?= h($participantes->nombre) ?></td>
                <td><?= h($participantes->apellidos) ?></td>
                <td><?= h($participantes->nacimiento) ?></td>
                <td><?= h($participantes->sexo) ?></td>
                <td><?= h($participantes->telefono) ?></td>
                <td><?= h($participantes->email) ?></td>
                <td><?= h($participantes->expediente_id) ?></td>
                <td><?= h($participantes->created) ?></td>
                <td><?= h($participantes->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Participantes', 'action' => 'view', $participantes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Participantes', 'action' => 'edit', $participantes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Participantes', 'action' => 'delete', $participantes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $participantes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Roles') ?></h4>
        <?php if (!empty($expediente->roles)): ?>
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
            <?php foreach ($expediente->roles as $roles): ?>
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
