<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $informe->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $informe->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Informes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Expedientes'), ['controller' => 'Expedientes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Expediente'), ['controller' => 'Expedientes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="informes form large-9 medium-8 columns content">
    <?= $this->Form->create($informe) ?>
    <fieldset>
        <legend><?= __('Edit Informe') ?></legend>
        <?php
            echo $this->Form->input('antecedentes');
            echo $this->Form->input('situacion');
            echo $this->Form->input('pii');
            echo $this->Form->input('valoracion');
            echo $this->Form->input('propuesta');
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('fecha');
            echo $this->Form->input('estado');
            echo $this->Form->input('expediente_id', ['options' => $expedientes]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
