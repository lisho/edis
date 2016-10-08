<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $prestacion->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $prestacion->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Prestacions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Expedientes'), ['controller' => 'Expedientes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Expediente'), ['controller' => 'Expedientes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Participantes'), ['controller' => 'Participantes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Participante'), ['controller' => 'Participantes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="prestacions form large-9 medium-8 columns content">
    <?= $this->Form->create($prestacion) ?>
    <fieldset>
        <legend><?= __('Edit Prestacion') ?></legend>
        <?php
            echo $this->Form->input('numprestacion');
            echo $this->Form->input('tipoprestacion_id');
            echo $this->Form->input('apertura');
            echo $this->Form->input('cierre', ['empty' => true]);
            echo $this->Form->input('expediente_id', ['options' => $expedientes]);
            echo $this->Form->input('participante_id', ['options' => $participantes]);
            echo $this->Form->input('estadoprestacion_id');
            echo $this->Form->input('observaciones');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
