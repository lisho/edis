<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Migrausuario'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="migrausuarios index large-9 medium-8 columns content">
    <h3><?= __('Migrausuarios') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('dni') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sexo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nombre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('apellidos') ?></th>
                <th scope="col"><?= $this->Paginator->sort('telefono') ?></th>
                <th scope="col"><?= $this->Paginator->sort('numedis') ?></th>
                <th scope="col"><?= $this->Paginator->sort('relacion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nacimineto') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nacionalidad') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($migrausuarios as $migrausuario): ?>
            <tr>
                <td><?= $this->Number->format($migrausuario->id) ?></td>
                <td><?= h($migrausuario->dni) ?></td>
                <td><?= h($migrausuario->sexo) ?></td>
                <td><?= h($migrausuario->nombre) ?></td>
                <td><?= h($migrausuario->apellidos) ?></td>
                <td><?= h($migrausuario->telefono) ?></td>
                <td><?= h($migrausuario->numedis) ?></td>
                <td><?= h($migrausuario->relacion) ?></td>
                <td><?= h($migrausuario->nacimineto) ?></td>
                <td><?= h($migrausuario->nacionalidad) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $migrausuario->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $migrausuario->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $migrausuario->id], ['confirm' => __('Are you sure you want to delete # {0}?', $migrausuario->id)]) ?>
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
