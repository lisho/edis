<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $prestacionestado->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $prestacionestado->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Prestacionestados'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="prestacionestados form large-9 medium-8 columns content">
    <?= $this->Form->create($prestacionestado) ?>
    <fieldset>
        <legend><?= __('Edit Prestacionestado') ?></legend>
        <?php
            echo $this->Form->input('estado');
            echo $this->Form->input('observaciones');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
