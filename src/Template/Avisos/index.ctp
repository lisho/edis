<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Aviso'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="avisos index large-9 medium-8 columns content">
    <h3><?= __('Avisos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('titulo') ?></th>
                <th><?= $this->Paginator->sort('caduca') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($avisos as $aviso): ?>
            <tr>
                <td><?= $this->Number->format($aviso->id) ?></td>
                <td><?= h($aviso->titulo) ?></td>
                <td><?= h($aviso->caduca) ?></td>
                <td><?= h($aviso->created) ?></td>
                <td><?= h($aviso->modified) ?></td>
                <td><?= $aviso->has('user') ? $this->Html->link($aviso->user->dni, ['controller' => 'Users', 'action' => 'view', $aviso->user->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $aviso->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $aviso->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $aviso->id], ['confirm' => __('Are you sure you want to delete # {0}?', $aviso->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
