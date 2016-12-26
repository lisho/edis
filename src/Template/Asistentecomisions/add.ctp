<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Asistentecomisions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Comisions'), ['controller' => 'Comisions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Comision'), ['controller' => 'Comisions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tecnicos'), ['controller' => 'Tecnicos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tecnico'), ['controller' => 'Tecnicos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="asistentecomisions form large-9 medium-8 columns content">
    <?= $this->Form->create($asistentecomision) ?>
    <fieldset>
        <legend><?= __('Add Asistentecomision') ?></legend>
        <?php
            echo $this->Form->input('rol');
            echo $this->Form->input('comision_id', ['options' => $comisions]);
            echo $this->Form->input('tecnico_id', ['options' => $tecnicos]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
