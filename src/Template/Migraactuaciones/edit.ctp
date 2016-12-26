<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $migraactuacione->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $migraactuacione->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Migraactuaciones'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="migraactuaciones form large-9 medium-8 columns content">
    <?= $this->Form->create($migraactuacione) ?>
    <fieldset>
        <legend><?= __('Edit Migraactuacione') ?></legend>
        <?php
            echo $this->Form->input('id_antiguo');
            echo $this->Form->input('fecha');
            echo $this->Form->input('descripcion');
            echo $this->Form->input('dni');
            echo $this->Form->input('numedis');
            echo $this->Form->input('nombre');
            echo $this->Form->input('apellidos');
            echo $this->Form->input('actuacion');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
