<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Incidenciatipo'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Incidencias'), ['controller' => 'Incidencias', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Incidencia'), ['controller' => 'Incidencias', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="incidenciatipos index large-9 medium-8 columns content">
    <h3><?= __('Incidenciatipos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('tipo') ?></th>
                <th><?= $this->Paginator->sort('descripcion') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($incidenciatipos as $incidenciatipo): ?>
            <tr>
                <td><?= $this->Number->format($incidenciatipo->id) ?></td>
                <td><?= h($incidenciatipo->tipo) ?></td>
                <td><?= h($incidenciatipo->descripcion) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $incidenciatipo->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $incidenciatipo->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $incidenciatipo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $incidenciatipo->id)]) ?>
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
