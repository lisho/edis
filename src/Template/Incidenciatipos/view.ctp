<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Incidenciatipo'), ['action' => 'edit', $incidenciatipo->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Incidenciatipo'), ['action' => 'delete', $incidenciatipo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $incidenciatipo->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Incidenciatipos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Incidenciatipo'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Incidencias'), ['controller' => 'Incidencias', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Incidencia'), ['controller' => 'Incidencias', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="incidenciatipos view large-9 medium-8 columns content">
    <h3><?= h($incidenciatipo->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Tipo') ?></th>
            <td><?= h($incidenciatipo->tipo) ?></td>
        </tr>
        <tr>
            <th><?= __('Descripcion') ?></th>
            <td><?= h($incidenciatipo->descripcion) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($incidenciatipo->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Incidencias') ?></h4>
        <?php if (!empty($incidenciatipo->incidencias)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Fecha') ?></th>
                <th><?= __('Incidenciatipo Id') ?></th>
                <th><?= __('Descripcion') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Expediente Id') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($incidenciatipo->incidencias as $incidencias): ?>
            <tr>
                <td><?= h($incidencias->id) ?></td>
                <td><?= h($incidencias->fecha) ?></td>
                <td><?= h($incidencias->incidenciatipo_id) ?></td>
                <td><?= h($incidencias->descripcion) ?></td>
                <td><?= h($incidencias->user_id) ?></td>
                <td><?= h($incidencias->expediente_id) ?></td>
                <td><?= h($incidencias->created) ?></td>
                <td><?= h($incidencias->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Incidencias', 'action' => 'view', $incidencias->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Incidencias', 'action' => 'edit', $incidencias->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Incidencias', 'action' => 'delete', $incidencias->id], ['confirm' => __('Are you sure you want to delete # {0}?', $incidencias->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
