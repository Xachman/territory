<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Territories Controller
 *
 * @property \App\Model\Table\TerritoriesTable $Territories
 */
class TerritoriesController extends AppController {

    var $uses = array('User', 'DoNotCall');

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $territories = $this->paginate($this->Territories);

        $this->set(compact('territories'));
        $this->set('_serialize', ['territories']);
    }

    /**
     * View method
     *
     * @param string|null $id Territory id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $territory = $this->Territories->get($id, [
            'contain' => ['Users']
        ]);

        $this->territory($territory->territory_number);

    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $territory = $this->Territories->newEntity();
        if ($this->request->is('post')) {
            $territory = $this->Territories->patchEntity($territory, $this->request->data);
            if ($this->Territories->save($territory)) {
                $this->Flash->success(__('The territory has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The territory could not be saved. Please, try again.'));
            }
        }
        $users = $this->Territories->Users->find('list', ['keyField' => 'id', 'valueField' => function($e) {
                return $e->get('first_name') . ' ' . $e->get('last_name');
            }]);
        $this->set(compact('territory', 'users'));
        $this->set('_serialize', ['territory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Territory id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $territory = $this->Territories->get($id, [
            'contain' => []
        ]);
        $donotcalls = $this->loadModel('DoNotCalls')->find('all')->where(['territory_id' => $id]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            if (!$this->request->data["pdf"]) {
                unset($this->request->data["pdf"]);
            }
            if (!$this->request->data["image"]) {
                unset($this->request->data["image"]);
            }
            $territory = $this->Territories->patchEntity($territory, $this->request->data);
            if ($this->Territories->save($territory)) {
                $this->Flash->success(__('The territory has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The territory could not be saved. Please, try again.'));
            }
        }
        $users = $this->Territories->Users->find('list', ['keyField' => 'id', 'valueField' => function($e) {
                return $e->get('first_name') . ' ' . $e->get('last_name');
            }]);
        $this->set(compact('territory', 'users', 'donotcalls'));
        $this->set('_serialize', ['territory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Territory id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $territory = $this->Territories->get($id);
        if ($this->Territories->delete($territory)) {
            $this->Flash->success(__('The territory has been deleted.'));
        } else {
            $this->Flash->error(__('The territory could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function importJson() {
        $ch = curl_init();
        $url = 'http://westsalisbury.gtiwebdev.com/data/territories.php';
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        //execute post
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $results = json_decode(curl_exec($ch));
        curl_close($ch);
        echo '<pre>';
        //var_dump($results);
        echo '</pre>';

        foreach ($results as $result) {
            //echo $result->id;
            $territory = $this->Territories->find('all')->where(['territory_number' => (int) $result->id]);
            //echo $territory->toArray();
//            echo '<pre>';
//            var_dump(count($territory->toArray()));
//            echo '</pre>';
            if (count($territory->toArray()) === 0) {
                $data['pdf_dir'] = 'webroot/files/Territories/pdf/';
                $data['image_dir'] = 'webroot/files/Territories/image/';
                $data['pdf'] = $result->id . '.pdf';
                $data['image'] = $result->id . '.jpg';
                $data['territory_number'] = $result->id;
                $data['title'] = $result->name;
                $territory = $this->Territories->newEntity();
                $territory = $this->Territories->patchEntity($territory, $data);
                echo '<pre>';
                var_dump($territory);
                echo '</pre>';
                if ($this->Territories->save($territory)) {
                    echo $result->name . ' was saved<br>';
                } else {
                    echo $result->name . ' had an error<br>';
                }
            }
        }

        die;
//        $territory = $this->Territories->patchEntity($territory, $this->request->data);
//            if ($this->Territories->save($territory)) {
//                $this->Flash->success(__('The territory has been saved.'));
//                return $this->redirect(['action' => 'index']);
//            } else {
//                $this->Flash->error(__('The territory could not be saved. Please, try again.'));
//            }
    }

    public function territoryList($view = "") {
        $territories = $this->territoryListViewData($view);
        $this->set(compact('territories'));
    }
    public function listPrint($view = "") {
        $this->viewBuilder()->layout('print');
        $territories = $this->territoryListViewData($view);
        $this->set(compact('territories'));
    }
    public function territoryListViewData($view) {
        switch($view) {
            case "over-90-days":
                return $this->Territories->over90DaysOut();
            default:
                return $this->Territories->orderByIsCheckedOut()->order(["Territories.is_checked_out" => "DESC", "Territories.territory_number" => "ASC"]);
        }
    }
    public function territory($id = null) {
        $territory = $this->Territories->find()->where(['territory_number' => $id]);
        $territory = $territory->first();

        $checkouts = $this->loadModel('checkouts')->find('all')->where(['territory_id' => $territory->id])->orderDesc('checkout_date');
        //var_dump($checkouts->getIterator());
        $this->set(compact('territory', 'checkouts'));
        $this->set('_serialize', ['territory']);
    }

	public function territoryPages($page = 1) {
		$total_pages = 27;
        if($page != 'all') {	
            $territories = $this->Territories->find()->contain([
                'Checkouts' => [
                    "sort"	=> ["Checkouts.checkout_date" => "ASC"]
                ]
                ])->offset((($page - 1 ) * 3))->limit(3);
        }else{
            $territories = $this->Territories->find()->contain([
                'Checkouts' => [
                    "sort"	=> ["Checkouts.checkout_date" => "ASC"]
                ]
                ]);
        }
		$this->set(compact('territories', "page", "total_pages"));
	}

    public function checkin($id = null) {
        $checkouts = $this->loadModel('checkouts');
        $territory = $this->Territories->get($id, [
            'contain' => []
        ]);

        $checkout_array = $this->Territories->orderByIsCheckedOut()->where(['territory_id' => $id, "turnindate IS NULL"])->toArray();
        $checkout_id = $checkout_array[0]->checkout_id;

        $now = new \DateTime();
        $dateArray = [
            'year'      => $now->format('Y'),
            'month'     => $now->format('m'),
            'day'       => $now->format('d'),
            'hour'      => $now->format('H'),
            'minute'    => $now->format('i')
        ];
        if ($this->request->is(['patch', 'post', 'put', 'get'])) {
            $checkout = $checkouts->get($checkout_id);
            $checkout = $checkouts->patchEntity($checkout, ['turnindate' => $dateArray]);
            $territory = $this->Territories->patchEntity($territory, ['is_checked_out' => 0, 'checkout_id' => 0]);
            if ($this->Territories->save($territory)) {
                if($checkouts->save($checkout)){
                    $this->Flash->success(__('The territory has been checked in.'));
                    return $this->redirect(['action' => 'territoryList']);
                }else{
                    $this->Flash->success(__('The territory has been checked in. But the checkout turn in date was not changed.'));
                    return $this->redirect(['action' => 'territoryList']);
                }
            } else {
                $this->Flash->error(__('The territory could not be saved. Please, try again.'));
            }
        }
    }
    public function debugPdf() {
        $this->viewBuilder()->templatePath('Territories/pdf');
        $this->viewBuilder()->layoutPath('pdf');
        $total_pages = 27;	
        $page = 1;
		$territories = $this->Territories->find()->contain([
			'Checkouts' => [
				"sort"	=> ["Checkouts.checkout_date" => "ASC"]
			]
			])->offset((($page - 1 ) * 3))->limit(3);
	
		$this->set(compact('territories', "page", "total_pages"));
        $this->render('territory-pages', 'debug'); //your $this->viewVars will be actually used.
    }
}
