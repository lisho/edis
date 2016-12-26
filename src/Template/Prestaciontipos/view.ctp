<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Prestaciontipo'), ['action' => 'edit', $prestaciontipo->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Prestaciontipo'), ['action' => 'delete', $prestaciontipo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $prestaciontipo->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Prestaciontipos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Prestaciontipo'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="prestaciontipos view large-9 medium-8 columns content">
    <h3><?= h($prestaciontipo->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Tipo') ?></th>
            <td><?= h($prestaciontipo->tipo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Descripcion') ?></th>
            <td><?= h($prestaciontipo->descripcion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($prestaciontipo->id) ?></td>
        </tr>
    </table>
</div>
