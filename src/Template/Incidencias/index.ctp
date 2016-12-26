<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Incidencia'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Incidenciatipos'), ['controller' => 'Incidenciatipos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Incidenciatipo'), ['controller' => 'Incidenciatipos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Expedientes'), ['controller' => 'Expedientes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Expediente'), ['controller' => 'Expedientes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="incidencias index large-9 medium-8 columns content">
    <h3><?= __('Incidencias') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('fecha') ?></th>
                <th><?= $this->Paginator->sort('incidenciatipo_id') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('expediente_id') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($incidencias as $incidencia): ?>
            <tr>
                <td><?= $this->Number->format($incidencia->id) ?></td>
                <td><?= h($incidencia->fecha) ?></td>
                <td><?= $incidencia->has('incidenciatipo') ? $this->Html->link($incidencia->incidenciatipo->id, ['controller' => 'Incidenciatipos', 'action' => 'view', $incidencia->incidenciatipo->id]) : '' ?></td>
                <td><?= $incidencia->has('user') ? $this->Html->link($incidencia->user->dni, ['controller' => 'Users', 'action' => 'view', $incidencia->user->id]) : '' ?></td>
                <td><?= $incidencia->has('expediente') ? $this->Html->link($incidencia->expediente->id, ['controller' => 'Expedientes', 'action' => 'view', $incidencia->expediente->id]) : '' ?></td>
                <td><?= h($incidencia->created) ?></td>
                <td><?= h($incidencia->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $incidencia->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $incidencia->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $incidencia->id], ['confirm' => __('Are you sure you want to delete # {0}?', $incidencia->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
