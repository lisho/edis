<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Pasacomisions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Expedientes'), ['controller' => 'Expedientes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Expediente'), ['controller' => 'Expedientes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Comisions'), ['controller' => 'Comisions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Comision'), ['controller' => 'Comisions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="pasacomisions form large-9 medium-8 columns content">
    <?= $this->Form->create($pasacomision) ?>
    <fieldset>
        <legend><?= __('Add Pasacomision') ?></legend>
        <?php
            echo $this->Form->input('motivo');
            echo $this->Form->input('clasificacion');
            echo $this->Form->input('diligencia');
            echo $this->Form->input('informeedis');
            echo $this->Form->input('observaciones');
            echo $this->Form->input('expediente_id', ['options' => $expedientes]);
            echo $this->Form->input('comision_id', ['options' => $comisions]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
