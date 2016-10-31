<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Migraactuacione'), ['action' => 'edit', $migraactuacione->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Migraactuacione'), ['action' => 'delete', $migraactuacione->id], ['confirm' => __('Are you sure you want to delete # {0}?', $migraactuacione->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Migraactuaciones'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Migraactuacione'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="migraactuaciones view large-9 medium-8 columns content">
    <h3><?= h($migraactuacione->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Dni') ?></th>
            <td><?= h($migraactuacione->dni) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Numedis') ?></th>
            <td><?= h($migraactuacione->numedis) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($migraactuacione->nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Apellidos') ?></th>
            <td><?= h($migraactuacione->apellidos) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Actuacion') ?></th>
            <td><?= h($migraactuacione->actuacion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($migraactuacione->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Antiguo') ?></th>
            <td><?= $this->Number->format($migraactuacione->id_antiguo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha') ?></th>
            <td><?= h($migraactuacione->fecha) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Descripcion') ?></h4>
        <?= $this->Text->autoParagraph(h($migraactuacione->descripcion)); ?>
    </div>
</div>
