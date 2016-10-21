<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Migraexpediente'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="migraexpedientes index large-9 medium-8 columns content">
    <h3><?= __('Migraexpedientes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rgc') ?></th>
                <th scope="col"><?= $this->Paginator->sort('numedis') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tedis') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cc') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ceas') ?></th>
                <th scope="col"><?= $this->Paginator->sort('alta') ?></th>
                <th scope="col"><?= $this->Paginator->sort('baja') ?></th>
                <th scope="col"><?= $this->Paginator->sort('domicilio') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($migraexpedientes as $migraexpediente): ?>
            <tr>
                <td><?= $this->Number->format($migraexpediente->id) ?></td>
                <td><?= h($migraexpediente->rgc) ?></td>
                <td><?= h($migraexpediente->numedis) ?></td>
                <td><?= h($migraexpediente->tedis) ?></td>
                <td><?= h($migraexpediente->cc) ?></td>
                <td><?= h($migraexpediente->ceas) ?></td>
                <td><?= h($migraexpediente->alta) ?></td>
                <td><?= h($migraexpediente->baja) ?></td>
                <td><?= h($migraexpediente->domicilio) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $migraexpediente->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $migraexpediente->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $migraexpediente->id], ['confirm' => __('Are you sure you want to delete # {0}?', $migraexpediente->id)]) ?>
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
