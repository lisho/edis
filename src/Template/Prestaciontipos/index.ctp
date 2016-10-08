<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Prestaciontipo'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="prestaciontipos index large-9 medium-8 columns content">
    <h3><?= __('Prestaciontipos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tipo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('descripcion') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($prestaciontipos as $prestaciontipo): ?>
            <tr>
                <td><?= $this->Number->format($prestaciontipo->id) ?></td>
                <td><?= h($prestaciontipo->tipo) ?></td>
                <td><?= h($prestaciontipo->descripcion) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $prestaciontipo->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $prestaciontipo->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $prestaciontipo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $prestaciontipo->id)]) ?>
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
