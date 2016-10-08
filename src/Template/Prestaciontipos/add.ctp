<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Prestaciontipos'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="prestaciontipos form large-9 medium-8 columns content">
    <?= $this->Form->create($prestaciontipo) ?>
    <fieldset>
        <legend><?= __('Add Prestaciontipo') ?></legend>
        <?php
            echo $this->Form->input('tipo');
            echo $this->Form->input('descripcion');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
