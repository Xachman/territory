<div class="home">
    <?php if($over90DaysOut ) { ?>
    <div class="content columns large-6">
    <header id="header" class="medium-12 columns">
        <div class="columns">
            <h3>Out over 120 days</h3>
        </div>
    </header>
    <table>
        <tr>
            <th>Name</th>
            <th>Checkout Date</th>
            <th>Title</th>
            <th>Number</th>
        </tr>
        <?php
        $counter = 0;
    //echo count($taken_rows);
        foreach ($over90DaysOut->getIterator() as $out) {
        ?>
            <tr class="over-90">
                <td>
                        <h6><?= $out->checkout_name ?></h6>
                </td>
                <td><?= date("m/d/Y" , strtotime($out->checkout_date)) ?></td>
                <td>
                    <?php echo $this->Html->link(
                        $out->title,
                        ['controller' => 'Territories', 'action' => 'territory', $out->territory_number]
                    );   ?>
                </td>
                <td>
                    <?php echo $out->territory_number ?>
                </td>
            </tr>
            <?php
        }
    ?>
    </table>
    </div>
    <?php } ?>

    <?php if($oneYear ) { ?>
    <div class="content columns large-6">
    <header id="header" class="medium-12 columns">
        <div class="columns">
            <h3>Over one year not worked</h3>
        </div>

    </header>
    <table>
        <tr>
            <th>Name</th>
            <th>Turn In Date</th>
            <th>Title</th>
            <th>Number</th>
            <th>Checked Out</th>
        </tr>
        <?php
        $counter = 0;
    //echo count($taken_rows);
        foreach ($oneYear->getIterator() as $out) {
        ?>
            <tr class="over-90">
                <td>
                        <h6><?= $out->checkout_name ?></h6>
                </td>
                <td><?= date("m/d/Y" , strtotime($out->turnindate)) ?></td>
                <td>
                    <?php echo $this->Html->link(
                        $out->title,
                        ['controller' => 'Territories', 'action' => 'territory', $out->territory_number]
                    );   ?>
                </td>
                <td>
                    <?php echo $out->territory_number ?>
                </td>
                <td>
                    <?php echo ($out->is_checked_out)? "yes": "no" ?>
                </td>
            </tr>
            <?php
        }
    ?>
    </table>
    </div>
    <?php } ?>
</div>