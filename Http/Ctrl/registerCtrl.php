<?php

/**
 * registerCtrl
 * 
 * @category   Controller
 * @package    CMS
 * @author     Rafał Żygadło <rafal@maxkod.pl>
 
 * @copyright  2016 maxkod.pl
 * @version    1.0
 */

namespace Http\Ctrl;

use Core\Ctrl;
use Core\Request;
use Model\RegisterModel;
use Core\View;
use Http\Requests\RegisterRequest;

class registerCtrl extends Ctrl
{
  
    /**
     * Sends the activation email to the new user.
     *
     * @param string $to The recipient's email address.
     * @param string $key The activation key.
     */
    public function sendActivationEmail(string $to, string $key)
    {
        $email = new \Core\Email();
        $email->SendActivationLink($to, $key);
    }
    
    /**
     * Renders the registration form view.
     *
     * @param array $data Data to pass to the view (e.g., errors, old input).
     */
    private function renderRegistrationForm(array $data = [])
    {
        $view = new View('register/index', $data);
        $view->Render();
    }

    /**
     * Handles the registration form submission.
     * Validates input, creates a user, and sends an activation email.
     *
     * @param Request $request
     */
    public function do(Request $request)
    {
        $registerRequest = new RegisterRequest();
        if (!$registerRequest->validate()) {
            // If validation fails, re-render the form with errors and old input
            $this->renderRegistrationForm([
                'errors' => $registerRequest->getErrors(),
                'old' => $_POST
            ]);
            return;
        }

        $model = new RegisterModel();
        $email = $registerRequest->post('email');

        
        $password = $registerRequest->post('password');
        $userId = $model->CreateUser($email, $password);
        
        // Generate a unique activation key.
        $key = md5(uniqid(rand(), true));
        $model->SetActivationKey($userId, $key);
        
        $this->sendActivationEmail($email, $key);
        
        //$msg = new \Core\Msg();
        //$msg->AddInfo('Registration successful. Please check your email to activate your account.');
        
        // It's a good practice to redirect after a successful POST request
        // to prevent form re-submission on page refresh.
        header('Location: /login');
        exit();
    }
   
    /**
     * Displays the registration form.
     * This is the default action for the controller.
     */
    public function index()
    {
       $this->renderRegistrationForm();
    }
}
