<?php
/* @var $territories_taken Cake\ORM\Query */
/* @var $territories_open Cake\ORM\Query */


?>

<header id="header" class="medium-12 columns">
    <div class="columns medium-6">
        <h2>Territory List</h2>
    </div>
    <div class="columns medium-6">
    </div>

</header>
<div class="content">
<table>
    <tr>
        <th>Territory</th>
        <th>Checked out by</th>
        <th>Checkout</th>
		<th>Checkin</th>
        <th>Checked Out</th>
        <th>Actions</th>
    </tr>
    <?php
    $counter = 0;
//echo count($taken_rows);
    foreach ($territories->getIterator() as $terr) {
      ?>
        <tr class="<?= ($terr->is_checked_out)? "checked-out" : "" ?>">
            <td>
                    <h5><?= $terr->territory_number ?> <?= $terr->title ?></h5>
            </td>
            <td><?= $terr->checkout_name ?></td>
            <td><?= date("m/d/Y" , strtotime($terr->checkout_date)) ?></td>
            <td><?= ($terr->turnindate)?date("m/d/Y" , strtotime($terr->turnindate)) : "" ?></td>
            <td><?= ($terr->is_checked_out)? "Checked Out" : "" ?></td>
            <td>
            
                <a class="rtu" data="<?= $terr->id ?>" href="/territories/territory/<?= $terr->territory_number ?>">
                    <div class="link">Go to this Territory</div></a>
            </td>
        </tr>
        <?php
    }
 ?>
</table>
</div>