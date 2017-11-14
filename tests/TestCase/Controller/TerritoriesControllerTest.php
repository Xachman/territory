<?php
namespace App\Test\TestCase\Controller;

use App\Controller\TerritoriesController;
use Cake\TestSuite\IntegrationTestCase;
use Cake\ORM\TableRegistry;
/**
 * App\Controller\TerritoriesController Test Case
 */
class TerritoriesControllerTest extends IntegrationTestCase
{
    public function setUserSession() {
        $auth = [
            'Auth' => [
                'User' => [
                    'id' => 2,
                    'email' => 'john.doe@crm.com',
                    'firstname' => 'John',
                    'lastname' => 'Doe',
                    'gender' => 'm',
                    'birthday' => '1975-08-01',
                    'state' => 1,
                    'created' => '2015-04-01 22:26:51',
                    'modified' => '2015-04-01 22:26:51'
                ]
            ]
        ];
        return $auth;
    }

    public function setUp()
    {
        parent::setUp();
        $this->session($this->setUserSession());
    }
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.territories',
        'app.checkouts',
        'app.users'

    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }


    public function testCheckinLatestCheckout() {
        $this->get('/territories/checkin/3');
        $checkouts = TableRegistry::get('Checkouts');
        $checkoutsArray = $checkouts->find()->where(["id" =>  "3"])->toArray();
        $checkout = $checkoutsArray[0];
        $turnindate = $checkout->turnindate;
        $this->assertEquals(date("Y-m-d", strtotime($turnindate)), date("Y-m-d"));
    }
}
