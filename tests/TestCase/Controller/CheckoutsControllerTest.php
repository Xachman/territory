<?php
namespace App\Test\TestCase\Controller;

use App\Controller\CheckoutsController;
use Cake\TestSuite\IntegrationTestCase;
use Cake\ORM\TableRegistry;
use \App\Test\Fixture\ParticipantsFixture;

/**
 * App\Controller\CheckoutsController Test Case
 */
class CheckoutsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.checkouts',
        'app.territories',
        'app.users',
        'app.participants'
    
    ];
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
    public function testAddWithParticipant()
    {
        $data = [
            'first_name' => 'Tom',
            'last_name' => 'Brady',
            'email' => 'tom@brady.com',
            'territory_id' => '3',
            'checkout_date' => [
                'year' => '2017',
                'month' => '08',
                'day' => '06',
                'hour' => '07',
                'minute' => '57'
            ],
            'turnin_date' => [
                'year' => '',
                'month' => '',
                'day' => '',
                'hour' => '',
                'minute' => ''
            ]
        ];
        $this->post('/checkouts/add', $data);

        $this->assertResponseSuccess();
        $checkouts = TableRegistry::get('Checkouts');
        $query = $checkouts->find()->where(['name' => $data['first_name'].' '.$data['last_name']]);

        $participants = TableRegistry::get('Participants');
        $pquery = $participants->find()->where(['first_name' => $data['first_name'], 'last_name' => $data['last_name'], 'email' => $data['email']]);
        $this->assertEquals(1,$query->count());
        $this->assertTrue($query->toArray()[0]->participant_id > 0);
        $this->assertEquals(1,$pquery->count());
        $pquery2 = $participants->find('all');
        $pFixture = new ParticipantsFixture();
        $this->assertEquals(count($pFixture->records)+1,$pquery2->count());

    }
    /**
     * Test add method
     *
     * @return void
     */
    public function testAddWithParticipantUsedEmail()
    {
        $data = [
            'first_name' => 'Tom',
            'last_name' => 'Brady',
            'email' => 'bob@gmail.com',
            'territory_id' => '3',
            'checkout_date' => [
                'year' => '2017',
                'month' => '08',
                'day' => '06',
                'hour' => '07',
                'minute' => '57'
            ],
            'turnin_date' => [
                'year' => '',
                'month' => '',
                'day' => '',
                'hour' => '',
                'minute' => ''
            ]
        ];
        $this->post('/checkouts/add', $data);

        $this->assertResponseSuccess();
        $this->assertResponseContains("Email is already in use");
        $checkouts = TableRegistry::get('Checkouts');
        $query = $checkouts->find()->where(['name' => $data['first_name'].' '.$data['last_name']]);

        $participants = TableRegistry::get('Participants');
        $pquery = $participants->find()->where(['first_name' => $data['first_name'], 'last_name' => $data['last_name'], 'email' => $data['email']]);
        $this->assertEquals(0,$query->count());
        $this->assertEquals(0,$pquery->count());
        $pquery2 = $participants->find('all');
        $pFixture = new ParticipantsFixture();
        $this->assertEquals(count($pFixture->records),$pquery2->count());

    }
    public function testAdd() {
        $data = [
            'name' => 'Tom Brady',
            'territory_id' => '3',
            'checkout_date' => [
                'year' => '2017',
                'month' => '08',
                'day' => '06',
                'hour' => '07',
                'minute' => '57'
            ],
            'turnin_date' => [
                'year' => '',
                'month' => '',
                'day' => '',
                'hour' => '',
                'minute' => ''
            ]
        ];
        $this->post('/checkouts/add', $data);

        $this->assertResponseSuccess();
        $checkouts = TableRegistry::get('Checkouts');
        $query = $checkouts->find()->where(['name' => $data['name']]);

        $participants = TableRegistry::get('Participants');
        $pquery = $participants->find('all');
        $this->assertEquals(1,$query->count());
        $this->assertTrue(isset($query->toArray()[0]['uuid']));
        $pFixture = new ParticipantsFixture();
        $this->assertEquals(count($pFixture->records),$pquery->count());
    }
    public function testAddParticipantId() {

        $data = [
            'first_name' => 'Tom',
            'last_name' => 'Brady',
            'email' => 'tbrady@gmail.com',
            'territory_id' => '3',
            'participant_id' => '2',
            'checkout_date' => [
                'year' => '2017',
                'month' => '08',
                'day' => '06',
                'hour' => '07',
                'minute' => '57'
            ],
            'turnin_date' => [
                'year' => '',
                'month' => '',
                'day' => '',
                'hour' => '',
                'minute' => ''
            ]
        ];
        $this->post('/checkouts/add', $data);

        $this->assertResponseSuccess();
        $checkouts = TableRegistry::get('Checkouts');
        $participants = TableRegistry::get('Participants');

        $checkout = $checkouts->find('all',['order' => ['id'=>'DESC']])->first();
        $participant = $participants->get($data['participant_id']);
        $pquery = $participants->find('all');
        $this->assertEquals($participant->id, $checkout->participant_id);
        $this->assertTrue(isset($checkout->uuid));
        $this->assertEquals($participant->first_name . ' ' . $participant->last_name, $checkout->name);
        $pFixture = new ParticipantsFixture();
        $this->assertEquals(count($pFixture->records),$pquery->count());
    }
    /**



     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $data = [
            'id' => 4,
            'user' => 1,
            'name' => 'Ted Whilm',
            'territory_id' => 1,
            'participant_id' => 3,
        ];

        $this->post('/checkouts/edit/4', $data);

        $this->assertResponseSuccess();
        $checkouts = TableRegistry::get('Checkouts');
        $checkout = $checkouts->get(4);

        $this->assertEquals(3,$checkout->participant_id);
        $this->assertEquals('db193e7e-7bbc-11e7-bb31-be2e44b06b34',$checkout->uuid);

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
}