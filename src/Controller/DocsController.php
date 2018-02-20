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
        $nav = $this->generateNav();

        $this->set(compact('content', 'nav')); 

    }
    public function index() {
    }

    private function generateNav(): string {

        $html = '<ul class="side-nav">';
            $html .= '<li><a href="/Docs" >Home</a></li>';
        $files = scandir($this->view_path);
        if ($files) {
            foreach ($files as $file)
            {
                if ($file != "." && $file != ".." && strtolower(substr($file, strrpos($file, '.') + 1)) == 'md')
                {
                    
                    $sub = str_replace(substr($file, strrpos($file, '.')), "", $file);
                    if($sub == 'index') continue;
                    $linkName = '/'.$sub;
                    $name = ucwords(str_replace('_', ' ', $sub));

                    $html .= '<li><a href="/Docs'.$linkName.'" >'.$name.'</a></li>';

                }
            }
        }

        return $html."</ul>";
    }
       
}