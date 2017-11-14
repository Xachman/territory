<?php 
/* @var $dncHelper Cake\View\Helper\DoNotCallsHelper */
$dncHelper = $this->loadHelper('DoNotCalls');
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?=
            $this->Form->postLink(
                    __('Delete'), ['action' => 'delete', $territory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $territory->id)]
            )
            ?></li>
        <li><?= $this->Html->link(__('List Territories'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="territories form large-9 medium-8 columns content">
    <?= $this->Form->create($territory, ['type' => 'file']);?>
    <fieldset>
        <legend><?= __('Edit Territory') ?></legend>
        <?php
        echo $this->Form->input('user_id', [
            'options' => $users,
            'empty' => '-- Select --'
        ]);
        echo $this->Form->input('title');
        echo $this->Form->input('pdf', ['type' => 'file', 'value' => $territory->pdf]);
        echo $this->Form->input('is_checked_out', ['type' => 'checkbox', 'value' => 1, 'checked'=> ($territory->is_checked_out)? "checked": ""]);
        echo '<a href="/'.$territory->pdf_dir.$territory->pdf.'" target="_blank">View PDF</a>';
        echo $this->Form->input('image', ['type' => 'file', 'value' => $territory->image]);
        echo '<img src="/'.$territory->image_dir.''.$territory->image.'" />';
        echo $this->Form->input('description');
        echo $this->Form->input('url');
        echo $this->Form->input('territory_number', ['type' => 'number']);
        echo $this->Form->input('turnindate', ['empty' => true, 'type' => 'datetime']);
        ?>
         <?= $this->Form->button(__('Submit')) ?>
    </fieldset>
   
    <?= $this->Form->end() ?>
    <div class="clearfix"></div>
    <div class="do-not-calls">
        <?php
       echo $dncHelper->makeTerritoriesDoNotCallForm($donotcalls, $territory->id); ?>
        
    </div>
</div>
