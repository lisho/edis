<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Migraexpediente'), ['action' => 'edit', $migraexpediente->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Migraexpediente'), ['action' => 'delete', $migraexpediente->id], ['confirm' => __('Are you sure you want to delete # {0}?', $migraexpediente->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Migraexpedientes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Migraexpediente'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="migraexpedientes view large-9 medium-8 columns content">
    <h3><?= h($migraexpediente->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Rgc') ?></th>
            <td><?= h($migraexpediente->rgc) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Numedis') ?></th>
            <td><?= h($migraexpediente->numedis) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tedis') ?></th>
            <td><?= h($migraexpediente->tedis) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cc') ?></th>
            <td><?= h($migraexpediente->cc) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ceas') ?></th>
            <td><?= h($migraexpediente->ceas) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Domicilio') ?></th>
            <td><?= h($migraexpediente->domicilio) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($migraexpediente->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Alta') ?></th>
            <td><?= h($migraexpediente->alta) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Baja') ?></th>
            <td><?= h($migraexpediente->baja) ?></td>
        </tr>
    </table>
</div>
