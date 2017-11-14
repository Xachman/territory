<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;

class EmailsController extends AppController {
    public function sendTestEmail() {
        $email = new Email();
        $email->from(['territory@gtiwebdev.com' => 'Territory App'])
        ->to('zironside@hotmail.com')
        ->subject('Test Email From App')
        ->send('Test email from app!');
        debug($email);
        echo "done";
        die;
    }

    public function emailCheckout($checkoutId = 0) {
        if($checkoutId === 0) {
            $this->Flash->error(__('No checkout supplied'));
            return $this->redirect(['controller'=> 'checkout', 'action' => 'index']);
        }

        $this->loadModel('Checkouts');
        $checkout = $this->Checkouts->get($checkoutId);

        if(!$checkout) {
            $this->Flash->error(__('Could not find checkout'));
            return $this->redirect(['controller'=> 'checkout', 'action' => 'index']);
        }

        $this->loadModel('Participants');
        $participant = $this->Participants->get($checkout->participant_id);

        if(!$participant) {
            $this->Flash->error(__('Could not find participant'));
            return $this->redirect(['controller'=> 'checkout', 'action' => 'index']);
        }

        $this->loadModel('Territories');
        $territory = $this->Territories->get($checkout->territory_id);

        $email = new Email();
        $email->from(['territory@gtiwebdev.com' => 'Territory App'])
        ->to($participant->email)
        ->subject('Checkout for territory '.$territory->territory_number.' '.$territory->title)
        ->emailFormat('html')
        ->viewVars(['pdfurl' => $checkout->pdfurl])
        ->template('checkout');

        \ob_start();
        debug($email);
        $debug = \ob_get_clean();

        $emailLogData = [
            "email_from" => $email->from(),
            "content" => $debug,
            "subject" => $email->subject()
        ];
        $this->loadModel("EmailLogs");
        $emailLog = $this->EmailLogs->newEntity();
        $this->EmailLogs->patchEntity($emailLog,$emailLogData);
        $this->EmailLogs->save($emailLog); 
        $email->send();
        $this->Flash->success("Email Sent");
        $this->redirect(['controller' => 'checkouts', 'action' => 'view', $checkoutId]);
    }
}