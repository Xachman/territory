<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadModel("Users");
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $authOptions = [
            'loginRedirect' => [
                'controller' => 'Pages',
                'action' => 'index'
            ]
        ];

            $authOptions['logoutRedirect'] = [
                'controller' => 'Pages',
                'action' => 'display',
                'home'
            ];
        $this->loadComponent('Auth', $authOptions);

    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
        $userLink = $this->Auth->user();
        $this->set("userLink", $userLink);
    }
    
    public function beforeFilter(Event $event) {
        if(!$this->Users->isUsers()) {
            $this->Auth->allow(['action'=>'add','controller' => 'users']);
            if($this->request->controller != 'Users' && $this->request->action != "add")
                return $this->redirect(['controller' => 'users', 'action' => 'add']);
        }
    }

    protected function referBack() {
        return $this->redirect([
            "controller" => $this->request->query("referer"),
            "action" => $this->request->query("controller_action"),
            $this->request->query("param")
            ]);
    }

    protected function hasReferer() {
        if(isset($this->request->query["referer"]) && $this->request->query["referer"] != ""){
            return true;
        }
        return false;
    }
}
