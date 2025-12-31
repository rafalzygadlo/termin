<?php
/*
 *  
 *   registerCtrl.php
 *   
 *   @category   Controller
 *   @package    Core
 *   @author     rafal zygadlo rafal@zygadlo.org
 *   @copyright  Copyright (c) 2025 zygadlo.org
 *   @license    MIT
 *  
 */



namespace Ctrl;

use Core\Ctrl;
use Core\Request;
use Model\RegisterModel;
use Core\View;
use Core\Validator;

class registerCtrl extends Ctrl
{
  
   
    public function sendActivationEmail(string $to, string $key)
    {
        $email = new \Core\Email();
        $email->SendActivationLink($to, $key);
    }
    
    
    private function renderRegistrationForm(array $data = [])
    {
        $view = new View('register/index', $data);
        $view->Render();
    }

   
    public function do(Request $request)
    {
        $rules = [
            'email' => ['required', 'email', 'unique:user,email'],
            'password' => ['required', 'min:8'],
        ];
        $validator = new Validator($request->GetAllPost(), $rules);

        if (!$validator->Run()) 
        {
            // If validation fails, re-render the form with errors and old input
            $this->renderRegistrationForm([
                'errors' => $validator->errors,
                'old' => $request->GetAllPost()
            ]);
            return;
        }

        $validated = $validator->Validated();
        $model = new RegisterModel();
        $email = $validated['email'];
        $password = $validated['password'];
        $userId = $model->CreateUser($email, $password);
        
        // Generate a unique activation key.
        $key = md5(uniqid(rand(), true));
        $model->SetActivationKey($userId, $key);
        
        $this->sendActivationEmail($email, $key);
        
        //$msg = new \Core\Msg();
        //$msg->AddInfo('Registration successful. Please check your email to activate your account.');
        
        // It's a good practice to redirect after a successful POST request
        // to prevent form re-submission on page refresh.
        $this->redirect('/login');
    }
   
  
    public function index()
    {
       $this->renderRegistrationForm([
                'errors' => array(),
                'old' => array()
            ]);
    }
}
