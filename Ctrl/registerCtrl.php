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

namespace Ctrl;

use Core\Ctrl;
use Core\Tool;
use Model\RegisterModel;
use Core\View;

class registerCtrl extends Ctrl
{
  
   
    
    public function Insert($model, $key)
    {
       
        
    }
 
    public function SendEmail($to,$key)
    {
        $email = new \Core\Email();
        $email->SendActivationLink($to, $key);
    }
    

    private function RenderForm()
    {
        $view = new View();
        $view->Render('register/index');
    }

    public function Do()
    {
        $model = new RegisterModel();
        
        $email = "qotsa@op.pl";
        $password = "Tool::GetPost('password')";
        
        if($model->Exists('email', $email))
        {
            $msg = new \Core\Msg();
            $msg->AddError('Email already exists');
            $this->RenderForm();
            return;
        }
        
        $userId = $model->CreateUser($email, $password);
        
        $key = md5(uniqid(rand(), true));
        $model->SetActivationKey($userId, $key);
        
        $this->SendEmail($email, $key);
        
        $msg = new \Core\Msg();
        $msg->AddInfo('Registration successful. Please check your email to activate your account.');
        
    }
   
  
    public function Index()
    {
      
       $this->RenderForm();
        
       // $model = new RegisterModel();
        //$model->Exists('email', 'qotsa@op.pl');

        
    }


}
