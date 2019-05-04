<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Territory'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Territories'), ['action' => 'territoryList']) ?> </li>
    </ul>
</nav>
<div class="territories index large-9 medium-8 columns content">
    <h3><?= __('Territories') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('title') ?></th>
                <th><?= $this->Paginator->sort('pdf') ?></th>
                <th><?= $this->Paginator->sort('image') ?></th>
                <th><?= $this->Paginator->sort('territory_number') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($territories as $territory): ?>
            <tr>
                <td><?= $this->Number->format($territory->id) ?></td>
                <td><?= h($territory->title) ?></td>
                <td><?= h($territory->pdf) ?></td>
                <td><?= h($territory->image) ?></td>
                <td><?= $this->Number->format($territory->territory_number) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $territory->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $territory->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $territory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $territory->id)]) ?>
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
