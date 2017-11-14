<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CheckoutsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CheckoutsTable Test Case
 */
class CheckoutsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CheckoutsTable
     */
    public $Checkouts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.checkouts',
        'app.territories',
        'app.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Checkouts') ? [] : ['className' => 'App\Model\Table\CheckoutsTable'];
        $this->Checkouts = TableRegistry::get('Checkouts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Checkouts);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
