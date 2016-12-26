<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Prestacions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Prestaciontipos'), ['controller' => 'Prestaciontipos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Prestaciontipo'), ['controller' => 'Prestaciontipos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Expedientes'), ['controller' => 'Expedientes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Expediente'), ['controller' => 'Expedientes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Participantes'), ['controller' => 'Participantes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Participante'), ['controller' => 'Participantes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Prestacionestados'), ['controller' => 'Prestacionestados', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Prestacionestado'), ['controller' => 'Prestacionestados', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="prestacions form large-9 medium-8 columns content">
    <?= $this->Form->create($prestacion) ?>
    <fieldset>
        <legend><?= __('Add Prestacion') ?></legend>
        <?php
            echo $this->Form->input('numprestacion');
            echo $this->Form->input('prestaciontipo_id', ['options' => $prestaciontipos]);
            echo $this->Form->input('apertura');
            echo $this->Form->input('cierre', ['empty' => true]);
            echo $this->Form->input('expediente_id', ['options' => $expedientes]);
            echo $this->Form->input('participante_id', ['options' => $participantes]);
            echo $this->Form->input('prestacionestado_id', ['options' => $prestacionestados]);
            echo $this->Form->input('observaciones');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
