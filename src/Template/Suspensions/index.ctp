<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Suspension'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="suspensions index large-9 medium-8 columns content">
    <h3><?= __('Suspensions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('provincia') ?></th>
                <th scope="col"><?= $this->Paginator->sort('CCLL') ?></th>
                <th scope="col"><?= $this->Paginator->sort('CEAS') ?></th>
                <th scope="col"><?= $this->Paginator->sort('HS') ?></th>
                <th scope="col"><?= $this->Paginator->sort('UC') ?></th>
                <th scope="col"><?= $this->Paginator->sort('RGC') ?></th>
                <th scope="col"><?= $this->Paginator->sort('CLASIFICACION') ?></th>
                <th scope="col"><?= $this->Paginator->sort('MIEMBROS') ?></th>
                <th scope="col"><?= $this->Paginator->sort('dni') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nombrecompleto') ?></th>
                <th scope="col"><?= $this->Paginator->sort('SEXO') ?></th>
                <th scope="col"><?= $this->Paginator->sort('EDAD') ?></th>
                <th scope="col"><?= $this->Paginator->sort('NACIONALIDAD') ?></th>
                <th scope="col"><?= $this->Paginator->sort('DOMICILIO') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fechatramite') ?></th>
                <th scope="col"><?= $this->Paginator->sort('RESOLUCION') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fechaefectos') ?></th>
                <th scope="col"><?= $this->Paginator->sort('relacion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fechanomina') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($suspensions as $suspension): ?>
            <tr>
                <td><?= $this->Number->format($suspension->id) ?></td>
                <td><?= h($suspension->provincia) ?></td>
                <td><?= h($suspension->CCLL) ?></td>
                <td><?= h($suspension->CEAS) ?></td>
                <td><?= h($suspension->HS) ?></td>
                <td><?= h($suspension->UC) ?></td>
                <td><?= h($suspension->RGC) ?></td>
                <td><?= h($suspension->CLASIFICACION) ?></td>
                <td><?= h($suspension->MIEMBROS) ?></td>
                <td><?= h($suspension->dni) ?></td>
                <td><?= h($suspension->nombrecompleto) ?></td>
                <td><?= h($suspension->SEXO) ?></td>
                <td><?= h($suspension->EDAD) ?></td>
                <td><?= h($suspension->NACIONALIDAD) ?></td>
                <td><?= h($suspension->DOMICILIO) ?></td>
                <td><?= h($suspension->fechatramite) ?></td>
                <td><?= h($suspension->RESOLUCION) ?></td>
                <td><?= h($suspension->fechaefectos) ?></td>
                <td><?= h($suspension->relacion) ?></td>
                <td><?= h($suspension->fechanomina) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $suspension->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $suspension->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $suspension->id], ['confirm' => __('Are you sure you want to delete # {0}?', $suspension->id)]) ?>
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
