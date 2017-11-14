<?php 
$territoryArray = $territories->toArray(); 

?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Checkout'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Territories'), ['controller' => 'Territories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Territory'), ['controller' => 'Territories', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="checkouts index large-9 medium-8 columns content">
    <h3><?= __('Checkouts') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('territory_id') ?></th>
                <th><?= $this->Paginator->sort('checkout_date') ?></th>
                <th><?= $this->Paginator->sort('turnindate') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($checkouts as $checkout): ?>
            <tr>
<?php 

foreach($territoryArray as $territory) {
	if($territory["id"] == $checkout->territory_id) {
		$selectedTerritory = $territory;
	}
}
?>
                <td><?= h($checkout->name) ?></td>
                <td><?= $selectedTerritory["territory_number"]." ". $selectedTerritory["title"] ?></td>
                <td><?= h($checkout->checkout_date) ?></td>
                <td><?= h($checkout->turnindate) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $checkout->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $checkout->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $checkout->id], ['confirm' => __('Are you sure you want to delete # {0}?', $checkout->id)]) ?>
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
