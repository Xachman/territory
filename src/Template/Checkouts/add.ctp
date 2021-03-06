<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Checkouts'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Territories'), ['controller' => 'Territories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Territory'), ['controller' => 'Territories', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="checkouts form large-9 medium-8 columns content">
    <?= $this->Form->create($checkout) ?>
    <fieldset>
        <legend><?= __('Add Checkout') ?></legend>
        <?php
            echo $this->Form->input('user');
            echo $this->Form->input('name');
            echo $this->Form->input('territory_id', ['options' => $territories, "default" => $territory_id]);
            echo $this->Form->input('participant_id', [
                "options" => $participants,
                "empty" => "-- Select --"
            ]);
            echo $this->Form->input('checkout_date');
            echo $this->Form->input('turnindate', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
