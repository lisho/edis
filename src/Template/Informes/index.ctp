<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Informe'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Expedientes'), ['controller' => 'Expedientes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Expediente'), ['controller' => 'Expedientes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="informes index large-9 medium-8 columns content">
    <h3><?= __('Informes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fecha') ?></th>
                <th scope="col"><?= $this->Paginator->sort('expediente_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($informes as $informe): ?>
            <tr>
                <td><?= $this->Number->format($informe->id) ?></td>
                <td><?= $informe->has('user') ? $this->Html->link($informe->user->dni, ['controller' => 'Users', 'action' => 'view', $informe->user->id]) : '' ?></td>
                <td><?= h($informe->fecha) ?></td>
                <td><?= $informe->has('expediente') ? $this->Html->link($informe->expediente->id, ['controller' => 'Expedientes', 'action' => 'view', $informe->expediente->id]) : '' ?></td>
                <td><?= h($informe->created) ?></td>
                <td><?= h($informe->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $informe->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $informe->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $informe->id], ['confirm' => __('Are you sure you want to delete # {0}?', $informe->id)]) ?>
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
