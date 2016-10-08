<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Prestacion'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Expedientes'), ['controller' => 'Expedientes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Expediente'), ['controller' => 'Expedientes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Participantes'), ['controller' => 'Participantes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Participante'), ['controller' => 'Participantes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="prestacions index large-9 medium-8 columns content">
    <h3><?= __('Prestacions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('numprestacion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tipoprestacion_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('apertura') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cierre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('expediente_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('participante_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('estadoprestacion_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($prestacions as $prestacion): ?>
            <tr>
                <td><?= $this->Number->format($prestacion->id) ?></td>
                <td><?= h($prestacion->numprestacion) ?></td>
                <td><?= $this->Number->format($prestacion->tipoprestacion_id) ?></td>
                <td><?= h($prestacion->apertura) ?></td>
                <td><?= h($prestacion->cierre) ?></td>
                <td><?= $prestacion->has('expediente') ? $this->Html->link($prestacion->expediente->id, ['controller' => 'Expedientes', 'action' => 'view', $prestacion->expediente->id]) : '' ?></td>
                <td><?= $prestacion->has('participante') ? $this->Html->link($prestacion->participante->id, ['controller' => 'Participantes', 'action' => 'view', $prestacion->participante->id]) : '' ?></td>
                <td><?= $this->Number->format($prestacion->estadoprestacion_id) ?></td>
                <td><?= $this->Number->format($prestacion->created) ?></td>
                <td><?= $this->Number->format($prestacion->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $prestacion->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $prestacion->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $prestacion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $prestacion->id)]) ?>
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
