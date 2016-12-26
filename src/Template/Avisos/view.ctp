<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Aviso'), ['action' => 'edit', $aviso->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Aviso'), ['action' => 'delete', $aviso->id], ['confirm' => __('Are you sure you want to delete # {0}?', $aviso->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Avisos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Aviso'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="avisos view large-9 medium-8 columns content">
    <h3><?= h($aviso->titulo) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Titulo') ?></th>
            <td><?= h($aviso->titulo) ?></td>
        </tr>
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $aviso->has('user') ? $this->Html->link($aviso->user->dni, ['controller' => 'Users', 'action' => 'view', $aviso->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($aviso->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Caduca') ?></th>
            <td><?= h($aviso->caduca) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($aviso->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($aviso->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($aviso->description)); ?>
    </div>
    <div class="row">
        <h4><?= __('Tipo') ?></h4>
        <?= $this->Text->autoParagraph(h($aviso->tipo)); ?>
    </div>
    <div class="row">
        <h4><?= __('Importancia') ?></h4>
        <?= $this->Text->autoParagraph(h($aviso->importancia)); ?>
    </div>
</div>
