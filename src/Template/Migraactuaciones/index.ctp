<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Migraactuacione'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="migraactuaciones index large-9 medium-8 columns content">
    <h3><?= __('Migraactuaciones') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('id_antiguo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fecha') ?></th>
                <th scope="col"><?= $this->Paginator->sort('dni') ?></th>
                <th scope="col"><?= $this->Paginator->sort('numedis') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nombre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('apellidos') ?></th>
                <th scope="col"><?= $this->Paginator->sort('actuacion') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($migraactuaciones as $migraactuacione): ?>
            <tr>
                <td><?= $this->Number->format($migraactuacione->id) ?></td>
                <td><?= $this->Number->format($migraactuacione->id_antiguo) ?></td>
                <td><?= h($migraactuacione->fecha) ?></td>
                <td><?= h($migraactuacione->dni) ?></td>
                <td><?= h($migraactuacione->numedis) ?></td>
                <td><?= h($migraactuacione->nombre) ?></td>
                <td><?= h($migraactuacione->apellidos) ?></td>
                <td><?= h($migraactuacione->actuacion) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $migraactuacione->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $migraactuacione->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $migraactuacione->id], ['confirm' => __('Are you sure you want to delete # {0}?', $migraactuacione->id)]) ?>
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
