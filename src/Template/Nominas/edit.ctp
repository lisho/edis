<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $nomina->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $nomina->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Nominas'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="nominas form large-9 medium-8 columns content">
    <?= $this->Form->create($nomina) ?>
    <fieldset>
        <legend><?= __('Edit Nomina') ?></legend>
        <?php
            echo $this->Form->input('CCLL');
            echo $this->Form->input('CEAS');
            echo $this->Form->input('HS');
            echo $this->Form->input('RGC');
            echo $this->Form->input('CLASIFICACION');
            echo $this->Form->input('MIEMBROS');
            echo $this->Form->input('dni');
            echo $this->Form->input('nombrecompleto');
            echo $this->Form->input('SEXO');
            echo $this->Form->input('EDAD');
            echo $this->Form->input('NACIONALIDAD');
            echo $this->Form->input('DOMICILIO');
            echo $this->Form->input('fechatramite');
            echo $this->Form->input('RESOLUCION');
            echo $this->Form->input('fechaefectos');
            echo $this->Form->input('relacion');
            echo $this->Form->input('fechanomina');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
