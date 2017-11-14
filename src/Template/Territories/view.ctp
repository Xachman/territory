<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Territory'), ['action' => 'edit', $territory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Territory'), ['action' => 'delete', $territory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $territory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Territories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Territory'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="territories view large-9 medium-8 columns content">
    <h3><?= h($territory->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $territory->has('user') ? $this->Html->link($territory->user->id, ['controller' => 'Users', 'action' => 'view', $territory->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($territory->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Pdf') ?></th>
            <td><?= h($territory->pdf) ?></td>
        </tr>
        <tr>
            <th><?= __('Image') ?></th>
            <td><?= h($territory->image) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($territory->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created By') ?></th>
            <td><?= $this->Number->format($territory->created_by) ?></td>
        </tr>
        <tr>
            <th><?= __('Turnindate') ?></th>
            <td><?= h($territory->turnindate) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($territory->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($territory->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($territory->description)); ?>
    </div>
    <div class="row">
        <h4><?= __('Url') ?></h4>
        <?= $this->Text->autoParagraph(h($territory->url)); ?>
    </div>
</div>
