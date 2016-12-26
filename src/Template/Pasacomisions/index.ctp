<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Pasacomision'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Expedientes'), ['controller' => 'Expedientes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Expediente'), ['controller' => 'Expedientes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Comisions'), ['controller' => 'Comisions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Comision'), ['controller' => 'Comisions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="pasacomisions index large-9 medium-8 columns content">
    <h3><?= __('Pasacomisions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('diligencia') ?></th>
                <th><?= $this->Paginator->sort('informeedis') ?></th>
                <th><?= $this->Paginator->sort('expediente_id') ?></th>
                <th><?= $this->Paginator->sort('comision_id') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pasacomisions as $pasacomision): ?>
            <tr>
                <td><?= $this->Number->format($pasacomision->id) ?></td>
                <td><?= h($pasacomision->diligencia) ?></td>
                <td><?= h($pasacomision->informeedis) ?></td>
                <td><?= $pasacomision->has('expediente') ? $this->Html->link($pasacomision->expediente->id, ['controller' => 'Expedientes', 'action' => 'view', $pasacomision->expediente->id]) : '' ?></td>
                <td><?= $pasacomision->has('comision') ? $this->Html->link($pasacomision->comision->id, ['controller' => 'Comisions', 'action' => 'view', $pasacomision->comision->id]) : '' ?></td>
                <td><?= h($pasacomision->created) ?></td>
                <td><?= h($pasacomision->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $pasacomision->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $pasacomision->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $pasacomision->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pasacomision->id)]) ?>
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
