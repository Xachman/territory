<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * DoNotCalls Controller
 *
 * @property \App\Model\Table\DoNotCallsTable $DoNotCalls
 */
class DocsController extends AppController
{

    public function initialize() {
        parent::initialize();

        $this->loadComponent('Markdown.Markdown');
    }
    public function index() {

    }
}