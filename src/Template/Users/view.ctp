<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Territories'), ['controller' => 'Territories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Territory'), ['controller' => 'Territories', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($user->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Territories') ?></h4>
        <?php if (!empty($user->territories)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Title') ?></th>
                <th><?= __('Pdf') ?></th>
                <th><?= __('Image') ?></th>
                <th><?= __('Description') ?></th>
                <th><?= __('Url') ?></th>
                <th><?= __('Owner Id') ?></th>
                <th><?= __('Turnindate') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->territories as $territories): ?>
            <tr>
                <td><?= h($territories->id) ?></td>
                <td><?= h($territories->user_id) ?></td>
                <td><?= h($territories->title) ?></td>
                <td><?= h($territories->pdf) ?></td>
                <td><?= h($territories->image) ?></td>
                <td><?= h($territories->description) ?></td>
                <td><?= h($territories->url) ?></td>
                <td><?= h($territories->owner_id) ?></td>
                <td><?= h($territories->turnindate) ?></td>
                <td><?= h($territories->created) ?></td>
                <td><?= h($territories->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Territories', 'action' => 'view', $territories->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Territories', 'action' => 'edit', $territories->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Territories', 'action' => 'delete', $territories->id], ['confirm' => __('Are you sure you want to delete # {0}?', $territories->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
