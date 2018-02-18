<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * DoNotCalls Controller
 *
 * @property \App\Model\Table\DoNotCallsTable $DoNotCalls
 */
class DocsController extends AppController
{
    private $view_path; 
    public function initialize() {
        $this->view_path = dirname(dirname(__FILE__))."/Template/Docs";
        parent::initialize();

        $this->loadComponent('Markdown.Markdown');
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        
        $path = $this->view_path."/".join($this->request->params['pass'], "/").'.md';
        if(!$this->request->params['pass']) {
            $path = $this->view_path."/index.md";
        }
        $md = file_get_contents($path, true);
        $content = $this->Markdown->parse($md);
        $this->set(compact('content')); 

    }
    public function index() {
    }
}