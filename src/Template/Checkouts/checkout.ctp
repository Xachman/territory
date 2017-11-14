<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">

    </ul>
</nav>
<div class="checkouts form large-9 medium-8 columns content">
    <?= $this->Form->create($checkout, ['url' => ['controller' => 'Checkouts', 'action' => 'add', "referer" => "checkouts", "controller_action" => "checkout", "param" => $territory->territory_number]]) ?>
    <fieldset>
        <legend><?= __('Edit Checkout') ?></legend>
        <?php
        $now = new \DateTime();
        $turnin = new \DateTime('+90 days');
            echo $this->Form->input('territory_id',  ['value' => $territory->id, 'type'=>'hidden']);
            ?><div class="fields"><?php
            echo $this->Form->input('first_name', ['required' => true]); 
            echo $this->Form->input('last_name', ['required' => true]); 
            echo $this->Form->input('email');
            ?></div><?php
            echo $this->Form->input('participant_id', [
                "options" => $participants,
                "empty" => "-- Select --"
            ]);
            echo '<button id="showDates" class="small tiny">Change Dates</button>';
            echo '<div id="dateInputs" class="hidden">';
            echo $this->Form->input('checkout_date');
            echo $this->Form->input('turnindate', ['empty' => true]);
            echo '</div>';
            
            echo '<br>';
            echo '<div id="textdates">';
            echo 'Checkout: '.$now->format('Y-m-d H:i:s').'<br>';
            echo 'Trunin: '.$turnin->format('Y-m-d H:i:s').'<br>';
            echo '</div>';
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
<script>
    $('#showDates').click(function(e){
        e.preventDefault();
        var dateBox = $('#dateInputs');
        var text = $('#textdates');
        if(dateBox.css('display') === 'none') {
            dateBox.slideDown();
            text.slideUp();
        }else {
            dateBox.slideUp();
            text.slideDown();
        }
    });
    $('#participant-id').change(function(e){
        if($(this).val() > 0) {
            $('.fields').slideUp();
            $('.fields input').removeAttr("required")
        }else{
            $('.fields').slideDown();
            $('.fields input[name="first_name"]').attr("required", "required");
            $('.fields input[name="last_name"]').attr("required", "required");
        }
    })
</script>
