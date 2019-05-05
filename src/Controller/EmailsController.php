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
        $this->loadModel('Territories');
		$territory = $this->Territories->get($checkout->territory_id);
		$this->sendCheckoutEmail($checkoutId, 'Checkout for territory '.$territory->territory_number.' '.$territory->title,['pdfurl' => $checkout->pdfurl],'checkout');
        return $this->redirect(['controller' => 'checkouts', 'action' => 'view', $checkoutId]);
    }
	
    public function emailReminder($checkoutId = 0) {
        if($checkoutId === 0) {
            $this->Flash->error(__('No checkout supplied'));
            return $this->redirect(['controller'=> 'checkout', 'action' => 'index']);
        }

        $this->loadModel('Checkouts');
        $checkout = $this->Checkouts->get($checkoutId);
        $this->loadModel('Participants');
        $participant = $this->Participants->get($checkout->participant_id);
        $this->loadModel('Territories');
		$territory = $this->Territories->get($checkout->territory_id);
		$turnin = new \DateTime($checkout->checkout_date);
		$turnin->modify("+120 days");
		if(time() < $turnin->getTimeStamp()+86400) {
			$content = "<p>Hi ".$participant->first_name." ".$participant->last_name. "!</p>".
						"<p>The territory ".$territory->territory_number." ".$territory->title." is due to be checked back in on ".$turnin->format("m/d/Y"). ". <br>".
						"If you are unable to complete the territory by that date please contact your Service Overseer or Territory Servent.</p>"
			;
		}else{
			$content = "<p>Hi ".$participant->first_name." ".$participant->last_name. "!</p>".
						"<p>The territory ".$territory->territory_number." ".$territory->title." was due to be checked back in on ".$turnin->format("m/d/Y"). ". <br>".
						"Please contact your Service Overseer or Territory Servent.</p>"
			;
		}
		$this->sendCheckoutEmail($checkoutId, "Reminder for checkout of ".$territory->territory_number." ".$territory->title,['content' => $content],'checkout-reminder');
        return $this->redirect(['controller' => 'checkouts', 'action' => 'view', $checkoutId]);
    }
	private function sendCheckoutEmail($checkoutId = 0, $sub,$viewVars, $viewTmpl) {
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
        ->subject($sub)
        ->emailFormat('html')
        ->viewVars($viewVars)
        ->template($viewTmpl);

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

	}
}
