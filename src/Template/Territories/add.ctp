<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Territories'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="territories form large-9 medium-8 columns content">
    <?= $this->Form->create($territory, ['type' => 'file']);
        
        ?>
    <fieldset>
        <legend><?= __('Add Territory') ?></legend>
        <?php
        echo $this->Form->input('user_id', [
                'options' => $users,
                'empty' => '-- Select --'
            ]);
        echo $this->Form->input('title');
        echo $this->Form->create('pdf', ['type' => 'file']);
        echo $this->Form->input('pdf', ['type' => 'file']);
        echo $this->Form->input('image', ['type' => 'file']);
        echo $this->Form->input('description');
        echo $this->Form->input('url');
        echo $this->Form->input('territory_number', ['type' => 'number']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
