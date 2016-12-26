<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $migrausuario->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $migrausuario->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Migrausuarios'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="migrausuarios form large-9 medium-8 columns content">
    <?= $this->Form->create($migrausuario) ?>
    <fieldset>
        <legend><?= __('Edit Migrausuario') ?></legend>
        <?php
            echo $this->Form->input('dni');
            echo $this->Form->input('sexo');
            echo $this->Form->input('nombre');
            echo $this->Form->input('apellidos');
            echo $this->Form->input('telefono');
            echo $this->Form->input('otrosdatos');
            echo $this->Form->input('numedis');
            echo $this->Form->input('observaciones');
            echo $this->Form->input('relacion');
            echo $this->Form->input('nacimineto', ['empty' => true]);
            echo $this->Form->input('nacionalidad');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
