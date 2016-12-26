<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Relation'), ['action' => 'edit', $relation->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Relation'), ['action' => 'delete', $relation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $relation->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Relations'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Relation'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Participantes'), ['controller' => 'Participantes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Participante'), ['controller' => 'Participantes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="relations view large-9 medium-8 columns content">
    <h3><?= h($relation->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Nombre') ?></th>
            <td><?= h($relation->nombre) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($relation->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($relation->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($relation->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Participantes') ?></h4>
        <?php if (!empty($relation->participantes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Dni') ?></th>
                <th><?= __('Nombre') ?></th>
                <th><?= __('Apellidos') ?></th>
                <th><?= __('Nacimiento') ?></th>
                <th><?= __('Sexo') ?></th>
                <th><?= __('Telefono') ?></th>
                <th><?= __('Email') ?></th>
                <th><?= __('Foto') ?></th>
                <th><?= __('Relation Id') ?></th>
                <th><?= __('Observaciones') ?></th>
                <th><?= __('Expediente Id') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($relation->participantes as $participantes): ?>
            <tr>
                <td><?= h($participantes->id) ?></td>
                <td><?= h($participantes->dni) ?></td>
                <td><?= h($participantes->nombre) ?></td>
                <td><?= h($participantes->apellidos) ?></td>
                <td><?= h($participantes->nacimiento) ?></td>
                <td><?= h($participantes->sexo) ?></td>
                <td><?= h($participantes->telefono) ?></td>
                <td><?= h($participantes->email) ?></td>
                <td><?= h($participantes->foto) ?></td>
                <td><?= h($participantes->relation_id) ?></td>
                <td><?= h($participantes->observaciones) ?></td>
                <td><?= h($participantes->expediente_id) ?></td>
                <td><?= h($participantes->created) ?></td>
                <td><?= h($participantes->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Participantes', 'action' => 'view', $participantes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Participantes', 'action' => 'edit', $participantes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Participantes', 'action' => 'delete', $participantes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $participantes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
