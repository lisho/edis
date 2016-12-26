<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Asistentecomision'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Comisions'), ['controller' => 'Comisions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Comision'), ['controller' => 'Comisions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tecnicos'), ['controller' => 'Tecnicos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tecnico'), ['controller' => 'Tecnicos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="asistentecomisions index large-9 medium-8 columns content">
    <h3><?= __('Asistentecomisions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('comision_id') ?></th>
                <th><?= $this->Paginator->sort('tecnico_id') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($asistentecomisions as $asistentecomision): ?>
            <tr>
                <td><?= $this->Number->format($asistentecomision->id) ?></td>
                <td><?= $asistentecomision->has('comision') ? $this->Html->link($asistentecomision->comision->id, ['controller' => 'Comisions', 'action' => 'view', $asistentecomision->comision->id]) : '' ?></td>
                <td><?= $asistentecomision->has('tecnico') ? $this->Html->link($asistentecomision->tecnico->id, ['controller' => 'Tecnicos', 'action' => 'view', $asistentecomision->tecnico->id]) : '' ?></td>
                <td><?= h($asistentecomision->created) ?></td>
                <td><?= h($asistentecomision->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $asistentecomision->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $asistentecomision->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $asistentecomision->id], ['confirm' => __('Are you sure you want to delete # {0}?', $asistentecomision->id)]) ?>
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
