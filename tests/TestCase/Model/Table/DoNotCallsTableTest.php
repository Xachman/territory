<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DoNotCallsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DoNotCallsTable Test Case
 */
class DoNotCallsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DoNotCallsTable
     */
    public $DoNotCalls;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.do_not_calls',
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
        $config = TableRegistry::exists('DoNotCalls') ? [] : ['className' => 'App\Model\Table\DoNotCallsTable'];
        $this->DoNotCalls = TableRegistry::get('DoNotCalls', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DoNotCalls);

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
