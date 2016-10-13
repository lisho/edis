<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Nomina'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="nominas index large-9 medium-8 columns content">
    <h3><?= __('Nominas') ?></h3>
    <table class="table" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('CCLL') ?></th>
                <th scope="col"><?= $this->Paginator->sort('CEAS') ?></th>
                <th scope="col"><?= $this->Paginator->sort('HS') ?></th>
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
            <?php foreach ($nominas as $nomina): ?>
            <tr>
                <td><?= $this->Number->format($nomina->id) ?></td>
                <td><?= h($nomina->CCLL) ?></td>
                <td><?= h($nomina->CEAS) ?></td>
                <td><?= h($nomina->HS) ?></td>
                <td><?= h($nomina->RGC) ?></td>
                <td><?= h($nomina->CLASIFICACION) ?></td>
                <td><?= h($nomina->MIEMBROS) ?></td>
                <td><?= h($nomina->dni) ?></td>
                <td><?= h($nomina->nombrecompleto) ?></td>
                <td><?= h($nomina->SEXO) ?></td>
                <td><?= h($nomina->EDAD) ?></td>
                <td><?= h($nomina->NACIONALIDAD) ?></td>
                <td><?= h($nomina->DOMICILIO) ?></td>
                <td><?= h($nomina->fechatramite) ?></td>
                <td><?= h($nomina->RESOLUCION) ?></td>
                <td><?= h($nomina->fechaefectos) ?></td>
                <td><?= h($nomina->relacion) ?></td>
                <td><?= h($nomina->fechanomina) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $nomina->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $nomina->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $nomina->id], ['confirm' => __('Are you sure you want to delete # {0}?', $nomina->id)]) ?>
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
