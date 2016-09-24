<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Comisions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Asistentecomisions'), ['controller' => 'Asistentecomisions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Asistentecomision'), ['controller' => 'Asistentecomisions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Pasacomisions'), ['controller' => 'Pasacomisions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Pasacomision'), ['controller' => 'Pasacomisions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="comisions form large-9 medium-8 columns content">
    <?= $this->Form->create($comision) ?>
    <fieldset>
        <legend><?= __('Add Comision') ?></legend>
        <?php
            echo $this->Form->input('fecha');
            echo $this->Form->input('tipo');
            echo $this->Form->input('observaciones');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
