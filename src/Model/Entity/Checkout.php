<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Checkout Entity.
 *
 * @property int $id
 * @property int $user
 * @property string $name
 * @property int $territory_id
 * @property \App\Model\Entity\Territory $territory
 * @property \Cake\I18n\Time $checkout_date
 * @property \Cake\I18n\Time $turnindate
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Checkout extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];

    protected function _getPdfurl() {
        if($this->uuid) {
            return "/checkouts/viewpdf/".$this->uuid.".pdf";
        }
        return false;
    }
}
