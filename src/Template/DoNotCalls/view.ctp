<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Do Not Call'), ['action' => 'edit', $doNotCall->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Do Not Call'), ['action' => 'delete', $doNotCall->id], ['confirm' => __('Are you sure you want to delete # {0}?', $doNotCall->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Do Not Calls'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Do Not Call'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Territories'), ['controller' => 'Territories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Territory'), ['controller' => 'Territories', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="doNotCalls view large-9 medium-8 columns content">
    <h3><?= h($doNotCall->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Territory') ?></th>
            <td><?= $doNotCall->has('territory') ? $this->Html->link($doNotCall->territory->title, ['controller' => 'Territories', 'action' => 'view', $doNotCall->territory->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Address') ?></th>
            <td><?= h($doNotCall->address) ?></td>
        </tr>
        <tr>
            <th><?= __('City') ?></th>
            <td><?= h($doNotCall->city) ?></td>
        </tr>
        <tr>
            <th><?= __('State') ?></th>
            <td><?= h($doNotCall->state) ?></td>
        </tr>
        <tr>
            <th><?= __('Zipcode') ?></th>
            <td><?= h($doNotCall->zipcode) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($doNotCall->id) ?></td>
        </tr>
    </table>
</div>
