<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CheckoutsFixture
 *
 */
class CheckoutsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'user' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'name' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_unicode_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'territory_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'checkout_date' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'turnindate' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'uuid' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_unicode_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'participant_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'default' => 0, 'comment' => '', 'autoIncrement' => false, 'precision' => null],
        '_indexes' => [
            'territory' => ['type' => 'index', 'columns' => ['territory_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'territory' => ['type' => 'foreign', 'columns' => ['territory_id'], 'references' => ['territories', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_unicode_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'user' => 1,
            'name' => 'Lorem ipsum dolor sit amet',
            'territory_id' => 1,
            'checkout_date' => '2016-04-20 01:51:09',
            'turnindate' => '2016-06-08 01:51:09',
            'created' => '2016-04-20 01:51:09',
            'modified' => '2016-04-20 01:51:09',
            'uuid' => 'db193d5c-7bbc-11e7-bb31-be2e44b06b34'
        ],
        [
            'id' => 2,
            'user' => 1,
            'name' => 'Lorem ipsum dolor sit amet',
            'territory_id' => 3,
            'checkout_date' => '2016-07-20 01:51:09',
            'turnindate' => '2016-08-20 01:51:09',
            'created' => '2016-04-20 01:51:09',
            'modified' => '2016-04-20 01:51:09',
            'uuid' => 'db19388e-7bbc-11e7-bb31-be2e44b06b34'

        ],
        [
            'id' => 3,
            'user' => 1,
            'name' => 'Lorem ipsum dolor sit amet',
            'territory_id' => 3,
            'checkout_date' => '2016-08-20 01:51:09',
            'turnindate' => null,
            'created' => '2016-04-20 01:51:09',
            'modified' => '2016-04-20 01:51:09',
            'uuid' => '20238b18-ea1d-489f-aff8-d961a42f9ac7'

        ],
        [
            'id' => 4,
            'user' => 1,
            'name' => 'Ted Whilm',
            'territory_id' => 1,
            'participant_id' => 2,
            'checkout_date' => '2016-04-20 01:51:09',
            'turnindate' => '2016-04-20 01:51:09',
            'created' => '2016-04-20 01:51:09',
            'modified' => '2016-04-20 01:51:09',
            'uuid' => 'db193e7e-7bbc-11e7-bb31-be2e44b06b34'

        ],
    ];
}
