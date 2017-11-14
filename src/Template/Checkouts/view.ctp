<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Checkout'), ['action' => 'edit', $checkout->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Checkout'), ['action' => 'delete', $checkout->id], ['confirm' => __('Are you sure you want to delete # {0}?', $checkout->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Checkouts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Checkout'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Territories'), ['controller' => 'Territories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Territory'), ['controller' => 'Territories', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="checkouts view large-9 medium-8 columns content">
    <h3><?= h($checkout->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($checkout->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Territory') ?></th>
            <td><?= $checkout->has('territory') ? $this->Html->link($checkout->territory->title, ['controller' => 'Territories', 'action' => 'view', $checkout->territory->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($checkout->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Participant') ?></th>
            <td><?= $this->Number->format($checkout->participant_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Checkout Date') ?></th>
            <td><?= h($checkout->checkout_date) ?></td>
        </tr>
        <tr>
            <th><?= __('Turnindate') ?></th>
            <td><?= h($checkout->turnindate) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($checkout->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($checkout->modified) ?></td>
        </tr>
    </table>

    <?php 
    if(isset($checkout->uuid) && $checkout->uuid) { ?>
    <a class="button" href="<?php echo $checkout->pdfurl ?>">View PDF</a>
    <?php } 
    if(isset($checkout->participant_id) && $checkout->participant_id) {
    ?>
    <a class="button" href="/emails/email-checkout/<?php echo $checkout->id ?>">Send Email</a>
    <?php
    }
    ?>
</div>
