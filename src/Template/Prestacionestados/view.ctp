<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Prestacionestado'), ['action' => 'edit', $prestacionestado->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Prestacionestado'), ['action' => 'delete', $prestacionestado->id], ['confirm' => __('Are you sure you want to delete # {0}?', $prestacionestado->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Prestacionestados'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Prestacionestado'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="prestacionestados view large-9 medium-8 columns content">
    <h3><?= h($prestacionestado->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Estado') ?></th>
            <td><?= h($prestacionestado->estado) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Observaciones') ?></th>
            <td><?= h($prestacionestado->observaciones) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($prestacionestado->id) ?></td>
        </tr>
    </table>
</div>
