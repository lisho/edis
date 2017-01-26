<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Informe'), ['action' => 'edit', $informe->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Informe'), ['action' => 'delete', $informe->id], ['confirm' => __('Are you sure you want to delete # {0}?', $informe->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Informes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Informe'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Expedientes'), ['controller' => 'Expedientes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Expediente'), ['controller' => 'Expedientes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="informes view large-9 medium-8 columns content">
    <h3><?= h($informe->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $informe->has('user') ? $this->Html->link($informe->user->dni, ['controller' => 'Users', 'action' => 'view', $informe->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Expediente') ?></th>
            <td><?= $informe->has('expediente') ? $this->Html->link($informe->expediente->id, ['controller' => 'Expedientes', 'action' => 'view', $informe->expediente->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($informe->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha') ?></th>
            <td><?= h($informe->fecha) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($informe->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($informe->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Antecedentes') ?></h4>
        <?= $this->Text->autoParagraph(h($informe->antecedentes)); ?>
    </div>
    <div class="row">
        <h4><?= __('Situacion') ?></h4>
        <?= $this->Text->autoParagraph(h($informe->situacion)); ?>
    </div>
    <div class="row">
        <h4><?= __('Pii') ?></h4>
        <?= $this->Text->autoParagraph(h($informe->pii)); ?>
    </div>
    <div class="row">
        <h4><?= __('Valoracion') ?></h4>
        <?= $this->Text->autoParagraph(h($informe->valoracion)); ?>
    </div>
    <div class="row">
        <h4><?= __('Propuesta') ?></h4>
        <?= $this->Text->autoParagraph(h($informe->propuesta)); ?>
    </div>
    <div class="row">
        <h4><?= __('Estado') ?></h4>
        <?= $this->Text->autoParagraph(h($informe->estado)); ?>
    </div>
</div>
