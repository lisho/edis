<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $expediente->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $expediente->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Expedientes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Participantes'), ['controller' => 'Participantes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Participante'), ['controller' => 'Participantes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="expedientes form large-9 medium-8 columns content">
    <?= $this->Form->create($expediente) ?>
    <fieldset>
        <legend><?= __('Edit Expediente') ?></legend>
        <?php
            echo $this->Form->input('numedis');
            echo $this->Form->input('numrgc');
            echo $this->Form->input('domicilio');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
