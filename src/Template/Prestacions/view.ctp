<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Prestacion'), ['action' => 'edit', $prestacion->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Prestacion'), ['action' => 'delete', $prestacion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $prestacion->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Prestacions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Prestacion'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Expedientes'), ['controller' => 'Expedientes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Expediente'), ['controller' => 'Expedientes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Participantes'), ['controller' => 'Participantes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Participante'), ['controller' => 'Participantes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="prestacions view large-9 medium-8 columns content">
    <h3><?= h($prestacion->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Numprestacion') ?></th>
            <td><?= h($prestacion->numprestacion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Expediente') ?></th>
            <td><?= $prestacion->has('expediente') ? $this->Html->link($prestacion->expediente->id, ['controller' => 'Expedientes', 'action' => 'view', $prestacion->expediente->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Participante') ?></th>
            <td><?= $prestacion->has('participante') ? $this->Html->link($prestacion->participante->id, ['controller' => 'Participantes', 'action' => 'view', $prestacion->participante->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($prestacion->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tipoprestacion Id') ?></th>
            <td><?= $this->Number->format($prestacion->tipoprestacion_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Estadoprestacion Id') ?></th>
            <td><?= $this->Number->format($prestacion->estadoprestacion_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= $this->Number->format($prestacion->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= $this->Number->format($prestacion->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Apertura') ?></th>
            <td><?= h($prestacion->apertura) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cierre') ?></th>
            <td><?= h($prestacion->cierre) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Observaciones') ?></h4>
        <?= $this->Text->autoParagraph(h($prestacion->observaciones)); ?>
    </div>
</div>
