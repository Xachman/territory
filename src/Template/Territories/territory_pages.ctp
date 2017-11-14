<?php

/* @var $territories_taken Cake\ORM\Query */
/* @var $territories_open Cake\ORM\Query */


?>

<header id="header" class="medium-12 columns">
    <div class="columns medium-6">
        <h2>Territory Pages</h2>
    </div>
    <div class="columns medium-6">
    </div>

</header>
<div class="content">
    <?php
    $counter = 0;
//echo count($taken_rows);
    foreach ($territories->getIterator() as $terr) {
      ?>
	<div class="column medium-4">
		<table>
			<tr>
				<th colspan="2">
					<h5 class="left">
						<a href="<?=$this->Url->build(["controller" => "territories", "action" => "edit", $terr->id])?>"><?= $terr->territory_number ?> <?= $terr->title ?></a>  
					</h5>
					<span class="right small"><?=($terr->is_checked_out)? "Checked Out" : "" ?></span>
				</th>
			</tr>
			<?php
			foreach($terr->checkouts as $checkout) { ?>
			<tr>
				<td colspan="2"><?=$checkout->name?> <span class="link right"><?=$this->Html->link("Edit", ["controller" => "checkouts", "action" => "edit", $checkout->id, "referer" => "territories", "controller_action" => "territoryPages", "param" => $page ]) ?></span></td>
			</tr>
			<tr>
				<td>
					<?=($checkout->checkout_date)? date("m/d/y", strtotime($checkout->checkout_date)) : ""?>
				</td>
				<td>
					<?=($checkout->turnindate)? date("m/d/y", strtotime($checkout->turnindate)) : ""?>
				</td>
			</tr>
			<?php
			}
			?>
			<tr>
				<td>
					<a href="<?=$this->Url->build(["controller" => "checkouts", "action" => "add", $terr->id, "referer" => "territories", "controller_action" => "territoryPages", "param" => $page ])?>" class="button small">Add</a>
				</td>
			</tr>
		</table>
	</div>
        <?php
    }
 ?>
	<div class="clearfix"></div>
	<div class="page-nav">
		<span class="last"><a href="<?=$this->Url->build(["controller" => "territories", "action" => "territory-pages", ($page -1)]); ?>">Last</a></span>
		<span class="next right"><a href="<?=$this->Url->build(["controller" => "territories", "action" => "territory-pages", ($page +1)]); ?>">Next</a></span>
	</div>
</div>