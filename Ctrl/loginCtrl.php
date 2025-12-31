<?php

/**
 * loginCtrl
 * 
 * @category   Controller
 * @package    CMS
 * @author     Rafał Żygadło <rafal@maxkod.pl>
 
 * @copyright  2016 maxkod.pl
 * @version    1.0
 */

namespace Ctrl;

use Core\Ctrl;
use Core\View;
use Core\Session;
use Model\UserModel;
use Core\Request;
use Core\Validator;

class loginCtrl extends Ctrl
{
   
    public function do(Request $request)
    {
        $rules = [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
        $validator = new Validator($request->GetAllPost(), $rules);

        // If validation fails, $credentials will be empty
        if (!$validator->Run()) 
        {
            Session::FlashValidationState($validator->errors, $request->GetAllPost());
            $this->redirect('/login');
        }

        $credentials = $validator->Validated();

        if ((new UserModel)->Login($credentials['email'], $credentials['password'])) 
        {
            // On successful login, regenerate session ID to prevent session fixation
            session_regenerate_id(true);
            Session::Set('valid_user', true);
            $this->redirect('/dashboard');
        }

        // Handle failed login (wrong credentials)
        Session::FlashValidationState([[_msg('login.error')]], $request->GetAllPost());
        $this->redirect('/login');
    }

    public function index()
    {	   
        if(Session::Get('valid_user', false)) 
        {
            $this->redirect('/dashboard');
        }
        
        ['errors' => $errors, 'old' => $old] = Session::GetValidationState();

        $view = new View('login/index', ['errors' => $errors, 'old' => $old]);
        $view->Render();
          
    }
    
}
