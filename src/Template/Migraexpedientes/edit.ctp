<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $migraexpediente->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $migraexpediente->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Migraexpedientes'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="migraexpedientes form large-9 medium-8 columns content">
    <?= $this->Form->create($migraexpediente) ?>
    <fieldset>
        <legend><?= __('Edit Migraexpediente') ?></legend>
        <?php
            echo $this->Form->input('rgc');
            echo $this->Form->input('numedis');
            echo $this->Form->input('tedis');
            echo $this->Form->input('cc');
            echo $this->Form->input('ceas');
            echo $this->Form->input('alta', ['empty' => true]);
            echo $this->Form->input('baja', ['empty' => true]);
            echo $this->Form->input('domicilio');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
