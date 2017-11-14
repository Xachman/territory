<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Do Not Call'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Territories'), ['controller' => 'Territories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Territory'), ['controller' => 'Territories', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="doNotCalls index large-9 medium-8 columns content">
    <h3><?= __('Do Not Calls') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('territory_id') ?></th>
                <th><?= $this->Paginator->sort('address') ?></th>
                <th><?= $this->Paginator->sort('city') ?></th>
                <th><?= $this->Paginator->sort('state') ?></th>
                <th><?= $this->Paginator->sort('zipcode') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($doNotCalls as $doNotCall): ?>
            <tr>
                <td><?= $this->Number->format($doNotCall->id) ?></td>
                <td><?= $doNotCall->has('territory') ? $this->Html->link($doNotCall->territory->title, ['controller' => 'Territories', 'action' => 'view', $doNotCall->territory->id]) : '' ?></td>
                <td><?= h($doNotCall->address) ?></td>
                <td><?= h($doNotCall->city) ?></td>
                <td><?= h($doNotCall->state) ?></td>
                <td><?= h($doNotCall->zipcode) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $doNotCall->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $doNotCall->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $doNotCall->id], ['confirm' => __('Are you sure you want to delete # {0}?', $doNotCall->id)]) ?>
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
