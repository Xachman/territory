<?php

namespace App\View\Helper;

use Cake\View\Helper;

class DoNotCallsHelper extends Helper {

    public $helpers = ['Form'];

    /**
     * 
     * @param Cake\ORM\Query $donotcalls
     * @return type
     */
    public function makeTerritoriesDoNotCallForm($donotcalls, $id) {
        ob_start();
        ?>
        <?= $this->Form->create(null, ['url' => ['controller' => 'do-not-calls', 'action' => 'add'], 'id' => 'dncAjaxForm']); ?>
        <div class="current">
            <div class="dnc-entry row"><div class="columns medium-10 values"></div><div class="columns medium-2 remove"></div></div>
            <?php
            foreach ($donotcalls as $row) {
                /* @var $row App\Model\Entity\DoNotCall */
                echo '<div class="dnc-entry row"><div class="columns medium-10 values">' . $row->get('address') . ', ' . $row->get('city') . ', ' . $row->get('state') . ' ' . $row->get('zipcode') . '</div><div class="columns medium-2 remove"><a href="/do-not-calls/edit/' . $row->get('id') . '" class="button tiny remove">Remove</a></div></div>';
            }
            ?>
        </div>
        <?= $this->Form->input('territory_id', ['type' => 'hidden', 'value' => $id]); ?>
        <?= $this->Form->input('ajax', ['type' => 'hidden', 'value' => '1']); ?>
        <div class="row">
            <div class="columns medium-3">
                <?= $this->Form->input('address'); ?>
            </div>
            <div class="columns medium-3">
                <?= $this->Form->input('city'); ?>
            </div>
            <div class="columns medium-2">
                <?= $this->Form->input('state'); ?>
            </div>
            <div class="columns medium-2">
                <?= $this->Form->input('zipcode'); ?>
            </div>
            <div class="columns medium-2">
                <?= $this->Form->button(__('add'), ['class' => 'add tiny']) ?>
            </div>
        </div>
        <?= $this->Form->end() ?>
        <script>
            (function ($) {
                var form = $('#dncAjaxForm');
                var addButton = $('#dncAjaxForm button.add');
                addButton.click(function (e) {
                    e.preventDefault();
                    var url = form.attr('action');
                    $.post(url, form.serialize(), function (data) {
                        console.log(data);
                        data = JSON.parse(data);
                        var entryRow = form.find('.current .dnc-entry').eq(0).clone();
                        form.find('.current').html(makeDncHtml(entryRow, data['data']));
                        
                    });
                });
                
                function makeDncHtml(row, data) {
                    var html = '';
                    for(var i = 0; i < data.length; i++) {
                        var d = data[i];
                        row.find('.values').html(d['address']+', '+d['city']+', '+d['state']+' '+d['zipcode']);
                        row.find('.remove').html('<a href="/do-not-calls/edit/'+d['id']+'" class="button tiny remove">Remove</a>');
                        html += row[0].outerHTML;
                    }
                    return html;
                }

            })(jQuery)
            
        </script>
        <?php
        return ob_get_clean();
        // Logic to create specially rormatted link goes here...
    }

}
