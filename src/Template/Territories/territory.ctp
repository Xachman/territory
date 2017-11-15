<?php

/* @var $checkouts Cake\ORM\Query */

?>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Territory'), ['action' => 'edit', $territory->id]) ?> </li>
        <li><?= $this->Html->link(__('List Territories'), ['action' => 'territoryList']) ?> </li>
        <?php if($territory->is_checked_out === 0){?><li><?= $this->Html->link(__('Checkout Territory'), ['controller' => 'Checkouts', 'action' => 'checkout', $territory->territory_number]) ?> </li><?php } ?>
        <?php if($territory->is_checked_out === 1){?><li><?= $this->Html->link(__('Checkin Territory'), ['controller' => 'Territories', 'action' => 'checkin', $territory->id]) ?> </li><?php } ?>
    </ul>
</nav>
<div class="territories view large-9 medium-8 columns content">
    <h3><?= h($territory->title) ?></h3>
    <img src="<?='/files/Territories/image/'.$territory->image?>" ?>
    </table>
    <div class="row">
        <h4><?= __('Checkouts') ?></h4>
        <table>
            <tr>
                <th> 
                    Name
                </th>
                <th> 
                    Checkout Date
                </th>
                <th> 
                    Turn in Date
                </th>
            </tr>
        <?php
        foreach($checkouts->getIterator() as $checkout){
            ?>
        <tr class="checkout">
            <td>
                <?= $this->Html->link($checkout->name, ['action' => 'view', 'controller' => 'Checkouts', $checkout->id]) ?>
            </td>
            <td>
                <?=$checkout->checkout_date->format('n/j/Y')?>
            </td>
            <td>
                <?php
                    if($checkout->turnindate) {
                        echo $checkout->turnindate->format('n/j/Y');
                    }
                ?>
            </td>
        </tr>
        <?php
        }
        ?>
        </table>
    </div>
</div>
