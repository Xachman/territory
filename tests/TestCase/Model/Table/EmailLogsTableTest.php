<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EmailLogsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EmailLogsTable Test Case
 */
class EmailLogsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EmailLogsTable
     */
    public $EmailLogs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.email_logs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('EmailLogs') ? [] : ['className' => 'App\Model\Table\EmailLogsTable'];
        $this->EmailLogs = TableRegistry::get('EmailLogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EmailLogs);

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
}
