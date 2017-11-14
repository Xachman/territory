<?php

/* @var $territories_taken Cake\ORM\Query */
/* @var $territories_open Cake\ORM\Query */


?>

<div class="pdf-content">
    <?php
//echo count($taken_rows);
	$columnCount = 0;
	$columns = 5;
    foreach ($territories->getIterator() as $terr) {
    $sectionCount = 15;
	$columnCount++;
      ?>
	<div class="page-column <?=(($columnCount % 5) == 0)? "last-column" : ""; ?> " >
		<table>
			<tr>
				<th colspan="2">
					<h5 class="title">
						<?= $terr->territory_number ?> <?php //$terr->title ?>
					</h5>
				</th>
			</tr>
			<?php
			foreach($terr->checkouts as $checkout) { ?>
			<tr>
				<td colspan="2" class="name"><?=$checkout->name?></td>
			</tr>
			<tr>
				<td class="date">
					<?=($checkout->checkout_date)? date("m/d/y", strtotime($checkout->checkout_date)) : ""?>
				</td>
				<td class="date">
					<?=($checkout->turnindate)? date("m/d/y", strtotime($checkout->turnindate)) : ""?>
				</td>
			</tr>
			<?php
			$sectionCount --;
			}
			for($i = $sectionCount; $i > 0; $i --) {
				?>

			<tr>
				<td colspan="2" class="name"></td>
			</tr>
			<tr>
				<td class="date">
				</td>
				<td class="date">
				</td>
			</tr>
				<?php
			}
			?>
		</table>
	</div>
        <?php
    }
 ?>
	<div class="clearfix"></div>
</div>
</body>
</html>