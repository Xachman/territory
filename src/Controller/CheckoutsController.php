<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Controller\EmailsController;
use Cake\Event\Event;
/**
 * Checkouts Controller
 *
 * @property \App\Model\Table\CheckoutsTable $Checkouts
 */
class CheckoutsController extends AppController {

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        if( isset($this->request->_ext) && $this->request->_ext == "pdf") {
            $this->Auth->allow('viewpdf');
        }
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $this->paginate = [
            'contain' => ['Territories']
        ];
        $checkouts = $this->paginate($this->Checkouts);
		$this->loadModel('Territories');
		$territories = $this->Territories->find('all');
        $this->set(compact('checkouts'));
		$this->set('_serialize', ['checkouts']);
		$this->set(compact('territories'));
		$this->set('_serialize', ['territories']);;
    }

    /**
     * View method
     *
     * @param string|null $id Checkout id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $this->loadModel('Territories');
        $this->loadModel('DoNotCalls');
        $checkout = $this->Checkouts->get($id);
        $territory = $this->Territories->get($checkout->territory_id);
        $doNotCalls = $this->DoNotCalls->find('all', array(
            "conditions" => array(
                "territory_id" => $checkout->territory_id
            )
        ));
        $this->set('checkout', $checkout);
        $this->set('territory', $territory);
        $this->set('doNotCalls', $doNotCalls);
        $this->set('_serialize', ['checkout']);
    }

    public function viewpdf($uuid = null, $name = null) {
        $checkout = $this->Checkouts->find("all", array(
            "conditions" => array(
                "uuid" => $uuid
            )
        ))->first();

        if($checkout == null) {
            $this->render("not_found");
        }else{
            $this->view($checkout->id);
            $this->render("view");
        }
    }
    
    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($territory_id = 0) {
        $checkout = $this->Checkouts->newEntity();
        if ($this->request->is('post')) {
            $checkout = $this->Checkouts->patchEntity($checkout, $this->request->data);
            $participants = $this->loadModel('participants');
            $participant = $participants->newEntity();
            $participant = $participants->patchEntity($participant, $this->request->data);
            if(!isset($checkout->participant_id) && $participants->save($participant)) {
                $checkout->participant_id = $participant->id;
            }
            $errors = $participant->errors();
            if(isset($errors["email"]["_isUnique"])) {
               $this->Flash->error("Email is already in use");
               if($this->hasReferer()) {
                   return $this->referBack();
               } 
            }else{
                if ($this->Checkouts->save($checkout)) {
                    $territory = $this->loadModel('Territories')->get($this->request->data['territory_id'], [
                        'contain' => []
                    ]);
                    $territory = $this->loadModel('territories')->patchEntity($territory, ['is_checked_out' => 1, 'checkout_id' => $checkout->id]);
					if ($this->loadModel('territories')->save($territory )) {
						// email participant 
						if($checkout->participant_id) {
							$emailsController = new EmailsController();
							$emailsController->emailCheckout($checkout->id);
						}
                        $this->Flash->success(__('The checkout has been saved.'));
                        if($this->hasReferer()) {
                            return $this->referBack();
                        }
                        return $this->redirect(['action' => 'index']);
                    }
                    
                } else {
                    $this->Flash->error(__('The checkout could not be saved. Please, try again.'));
                }
            }
		}
        $territories = $this->Checkouts->Territories->find('list', ['limit' => 200]);
        $participants = $this->Checkouts->Participants->find('list', ['keyField' => 'id', 'valueField' => function($e) {
                return $e->get('first_name') . ' ' . $e->get('last_name');
            }]);
        $this->set(compact('checkout', 'territories', 'territory_id', 'participants'));
        $this->set('_serialize', ['checkout']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Checkout id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $checkout = $this->Checkouts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $checkout = $this->Checkouts->patchEntity($checkout, $this->request->data);
            if ($this->Checkouts->save($checkout)) {
                $this->Flash->success(__('The checkout has been saved.'));
                if($this->hasReferer()) {
                    return $this->referBack();
                }
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The checkout could not be saved. Please, try again.'));
            }
        }
        $territories = $this->Checkouts->Territories->find('list', ['limit' => 200]);
        $this->set(compact('checkout', 'territories'));
        $this->set('_serialize', ['checkout']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Checkout id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $checkout = $this->Checkouts->get($id);
        if ($this->Checkouts->delete($checkout)) {
            $this->Flash->success(__('The checkout has been deleted.'));
        } else {
            $this->Flash->error(__('The checkout could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function checkout($territoryNumber = null) {
        $territory = $this->loadModel('territories')->find()->where(['territory_number' => $territoryNumber]);
        $territory = $territory->first();
        $checkout = $this->Checkouts->newEntity();
        $this->loadModel("Participants");
        $participants = $this->Checkouts->Participants->find('list', ['keyField' => 'id', 'valueField' => function($e) {
                return $e->get('first_name') . ' ' . $e->get('last_name');
            }]);

        $this->set(compact('checkout', 'territory', 'participants'));
        $this->set('_serialize', ['territory']);
    }

}
