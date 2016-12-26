<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Incidencia'), ['action' => 'edit', $incidencia->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Incidencia'), ['action' => 'delete', $incidencia->id], ['confirm' => __('Are you sure you want to delete # {0}?', $incidencia->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Incidencias'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Incidencia'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Incidenciatipos'), ['controller' => 'Incidenciatipos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Incidenciatipo'), ['controller' => 'Incidenciatipos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Expedientes'), ['controller' => 'Expedientes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Expediente'), ['controller' => 'Expedientes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="incidencias view large-9 medium-8 columns content">
    <h3><?= h($incidencia->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Incidenciatipo') ?></th>
            <td><?= $incidencia->has('incidenciatipo') ? $this->Html->link($incidencia->incidenciatipo->id, ['controller' => 'Incidenciatipos', 'action' => 'view', $incidencia->incidenciatipo->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $incidencia->has('user') ? $this->Html->link($incidencia->user->dni, ['controller' => 'Users', 'action' => 'view', $incidencia->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Expediente') ?></th>
            <td><?= $incidencia->has('expediente') ? $this->Html->link($incidencia->expediente->id, ['controller' => 'Expedientes', 'action' => 'view', $incidencia->expediente->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($incidencia->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Fecha') ?></th>
            <td><?= h($incidencia->fecha) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($incidencia->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($incidencia->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Descripcion') ?></h4>
        <?= $this->Text->autoParagraph(h($incidencia->descripcion)); ?>
    </div>
</div>
