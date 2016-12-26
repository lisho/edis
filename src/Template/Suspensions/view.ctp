<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Suspension'), ['action' => 'edit', $suspension->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Suspension'), ['action' => 'delete', $suspension->id], ['confirm' => __('Are you sure you want to delete # {0}?', $suspension->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Suspensions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Suspension'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="suspensions view large-9 medium-8 columns content">
    <h3><?= h($suspension->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Provincia') ?></th>
            <td><?= h($suspension->provincia) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CCLL') ?></th>
            <td><?= h($suspension->CCLL) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CEAS') ?></th>
            <td><?= h($suspension->CEAS) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('HS') ?></th>
            <td><?= h($suspension->HS) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('UC') ?></th>
            <td><?= h($suspension->UC) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('RGC') ?></th>
            <td><?= h($suspension->RGC) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CLASIFICACION') ?></th>
            <td><?= h($suspension->CLASIFICACION) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('MIEMBROS') ?></th>
            <td><?= h($suspension->MIEMBROS) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dni') ?></th>
            <td><?= h($suspension->dni) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nombrecompleto') ?></th>
            <td><?= h($suspension->nombrecompleto) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('SEXO') ?></th>
            <td><?= h($suspension->SEXO) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('EDAD') ?></th>
            <td><?= h($suspension->EDAD) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('NACIONALIDAD') ?></th>
            <td><?= h($suspension->NACIONALIDAD) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('DOMICILIO') ?></th>
            <td><?= h($suspension->DOMICILIO) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('RESOLUCION') ?></th>
            <td><?= h($suspension->RESOLUCION) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Relacion') ?></th>
            <td><?= h($suspension->relacion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fechanomina') ?></th>
            <td><?= h($suspension->fechanomina) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($suspension->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fechatramite') ?></th>
            <td><?= h($suspension->fechatramite) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fechaefectos') ?></th>
            <td><?= h($suspension->fechaefectos) ?></td>
        </tr>
    </table>
</div>
