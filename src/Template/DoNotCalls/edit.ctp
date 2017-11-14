<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $doNotCall->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $doNotCall->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Do Not Calls'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Territories'), ['controller' => 'Territories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Territory'), ['controller' => 'Territories', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="doNotCalls form large-9 medium-8 columns content">
    <?= $this->Form->create($doNotCall) ?>
    <fieldset>
        <legend><?= __('Edit Do Not Call') ?></legend>
        <?php
            echo $this->Form->input('territory_id', ['options' => $territories]);
            echo $this->Form->input('address');
            echo $this->Form->input('city');
            echo $this->Form->input('state');
            echo $this->Form->input('zipcode');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
