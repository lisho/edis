<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Asistentecomision'), ['action' => 'edit', $asistentecomision->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Asistentecomision'), ['action' => 'delete', $asistentecomision->id], ['confirm' => __('Are you sure you want to delete # {0}?', $asistentecomision->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Asistentecomisions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Asistentecomision'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Comisions'), ['controller' => 'Comisions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Comision'), ['controller' => 'Comisions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tecnicos'), ['controller' => 'Tecnicos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tecnico'), ['controller' => 'Tecnicos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="asistentecomisions view large-9 medium-8 columns content">
    <h3><?= h($asistentecomision->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Comision') ?></th>
            <td><?= $asistentecomision->has('comision') ? $this->Html->link($asistentecomision->comision->id, ['controller' => 'Comisions', 'action' => 'view', $asistentecomision->comision->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Tecnico') ?></th>
            <td><?= $asistentecomision->has('tecnico') ? $this->Html->link($asistentecomision->tecnico->id, ['controller' => 'Tecnicos', 'action' => 'view', $asistentecomision->tecnico->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($asistentecomision->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($asistentecomision->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($asistentecomision->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Rol') ?></h4>
        <?= $this->Text->autoParagraph(h($asistentecomision->rol)); ?>
    </div>
</div>
