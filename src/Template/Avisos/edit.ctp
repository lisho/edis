<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $aviso->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $aviso->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Avisos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="avisos form large-9 medium-8 columns content">
    <?= $this->Form->create($aviso) ?>
    <fieldset>
        <legend><?= __('Edit Aviso') ?></legend>
        <?php
            echo $this->Form->input('titulo');
            echo $this->Form->input('description');
            echo $this->Form->input('tipo');
            echo $this->Form->input('importancia');
            echo $this->Form->input('caduca');
            echo $this->Form->input('user_id', ['options' => $users]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
