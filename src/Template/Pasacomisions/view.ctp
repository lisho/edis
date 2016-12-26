<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Pasacomision'), ['action' => 'edit', $pasacomision->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Pasacomision'), ['action' => 'delete', $pasacomision->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pasacomision->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Pasacomisions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Pasacomision'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Expedientes'), ['controller' => 'Expedientes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Expediente'), ['controller' => 'Expedientes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Comisions'), ['controller' => 'Comisions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Comision'), ['controller' => 'Comisions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="pasacomisions view large-9 medium-8 columns content">
    <h3><?= h($pasacomision->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Expediente') ?></th>
            <td><?= $pasacomision->has('expediente') ? $this->Html->link($pasacomision->expediente->id, ['controller' => 'Expedientes', 'action' => 'view', $pasacomision->expediente->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Comision') ?></th>
            <td><?= $pasacomision->has('comision') ? $this->Html->link($pasacomision->comision->id, ['controller' => 'Comisions', 'action' => 'view', $pasacomision->comision->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($pasacomision->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($pasacomision->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($pasacomision->modified) ?></td>
        </tr>
        <tr>
            <th><?= __('Diligencia') ?></th>
            <td><?= $pasacomision->diligencia ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th><?= __('Informeedis') ?></th>
            <td><?= $pasacomision->informeedis ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Motivo') ?></h4>
        <?= $this->Text->autoParagraph(h($pasacomision->motivo)); ?>
    </div>
    <div class="row">
        <h4><?= __('Clasificacion') ?></h4>
        <?= $this->Text->autoParagraph(h($pasacomision->clasificacion)); ?>
    </div>
    <div class="row">
        <h4><?= __('Observaciones') ?></h4>
        <?= $this->Text->autoParagraph(h($pasacomision->observaciones)); ?>
    </div>
</div>
