<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * DoNotCalls Controller
 *
 * @property \App\Model\Table\DoNotCallsTable $DoNotCalls
 */
class DoNotCallsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Territories']
        ];
        $doNotCalls = $this->paginate($this->DoNotCalls);

        $this->set(compact('doNotCalls'));
        $this->set('_serialize', ['doNotCalls']);
    }

    /**
     * View method
     *
     * @param string|null $id Do Not Call id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $doNotCall = $this->DoNotCalls->get($id, [
            'contain' => ['Territories']
        ]);

        $this->set('doNotCall', $doNotCall);
        $this->set('_serialize', ['doNotCall']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $doNotCall = $this->DoNotCalls->newEntity();
        if ($this->request->is('post')) {
            $isAjax = $this->request->data['ajax'];
            $doNotCall = $this->DoNotCalls->patchEntity($doNotCall, $this->request->data);
            if ($this->DoNotCalls->save($doNotCall)) {
                if($isAjax) {
                    $territory_id = $this->request->data['territory_id'];
                    $json['message'] = "Success";
                    $json['data'] = $this->DoNotCalls->find('all')->where(['territory_id' => $territory_id]);
                    echo json_encode($json);
                    die;
                }
                $this->Flash->success(__('The do not call has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The do not call could not be saved. Please, try again.'));
            }
        }
        $territories = $this->DoNotCalls->Territories->find('list', ['limit' => 200]);
        $this->set(compact('doNotCall', 'territories'));
        $this->set('_serialize', ['doNotCall']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Do Not Call id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $doNotCall = $this->DoNotCalls->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $doNotCall = $this->DoNotCalls->patchEntity($doNotCall, $this->request->data);
            if ($this->DoNotCalls->save($doNotCall)) {
                $this->Flash->success(__('The do not call has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The do not call could not be saved. Please, try again.'));
            }
        }
        $territories = $this->DoNotCalls->Territories->find('list', ['limit' => 200]);
        $this->set(compact('doNotCall', 'territories'));
        $this->set('_serialize', ['doNotCall']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Do Not Call id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $doNotCall = $this->DoNotCalls->get($id);
        if ($this->DoNotCalls->delete($doNotCall)) {
            $this->Flash->success(__('The do not call has been deleted.'));
        } else {
            $this->Flash->error(__('The do not call could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
