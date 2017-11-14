<?php
    $territoryImage = $territory->image_dir . $territory->image;
    $turnin = new \DateTime($checkout->checkout_date);
    $turnin->modify("+120 days");
?>
<h3 class="expires">Turn In Date: <?php echo $turnin->format("m/d/Y"); ?></h3>
<img style="width: 100%; height: auto" src="/var/www/<?=$territoryImage?>" />
<div class="boundary-key">
    <h3>Boundary Key:</h3>
    <div class="boundary-info" style="text-align: center">
        <span class="red" style="padding: 0 5px; background-color: red !important">Red is Do not Work either side</span>
        <span class="yellow" style="padding: 0 5px; background: yellow !important">Yellow Work inside only</span>
        <span class="green" style="padding: 0 5px; background: green !important">Green Work Both Sides</span>
    </div>
</div>
<div class="do-not-calls">
    <h3>Do Not Calls</h3>
    <?php foreach($doNotCalls->toArray() as $dnc) { ?>
        <div class="dnc"><?=$dnc["address"];?></div>
    <?php } ?>
</div>

