<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Migrausuario'), ['action' => 'edit', $migrausuario->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Migrausuario'), ['action' => 'delete', $migrausuario->id], ['confirm' => __('Are you sure you want to delete # {0}?', $migrausuario->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Migrausuarios'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Migrausuario'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="migrausuarios view large-9 medium-8 columns content">
    <h3><?= h($migrausuario->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Dni') ?></th>
            <td><?= h($migrausuario->dni) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sexo') ?></th>
            <td><?= h($migrausuario->sexo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($migrausuario->nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Apellidos') ?></th>
            <td><?= h($migrausuario->apellidos) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Telefono') ?></th>
            <td><?= h($migrausuario->telefono) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Numedis') ?></th>
            <td><?= h($migrausuario->numedis) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Relacion') ?></th>
            <td><?= h($migrausuario->relacion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nacionalidad') ?></th>
            <td><?= h($migrausuario->nacionalidad) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($migrausuario->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nacimineto') ?></th>
            <td><?= h($migrausuario->nacimineto) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Otrosdatos') ?></h4>
        <?= $this->Text->autoParagraph(h($migrausuario->otrosdatos)); ?>
    </div>
    <div class="row">
        <h4><?= __('Observaciones') ?></h4>
        <?= $this->Text->autoParagraph(h($migrausuario->observaciones)); ?>
    </div>
</div>
