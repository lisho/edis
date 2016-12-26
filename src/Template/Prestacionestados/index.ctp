<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Prestacionestado'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="prestacionestados index large-9 medium-8 columns content">
    <h3><?= __('Prestacionestados') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('estado') ?></th>
                <th scope="col"><?= $this->Paginator->sort('observaciones') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($prestacionestados as $prestacionestado): ?>
            <tr>
                <td><?= $this->Number->format($prestacionestado->id) ?></td>
                <td><?= h($prestacionestado->estado) ?></td>
                <td><?= h($prestacionestado->observaciones) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $prestacionestado->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $prestacionestado->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $prestacionestado->id], ['confirm' => __('Are you sure you want to delete # {0}?', $prestacionestado->id)]) ?>
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
