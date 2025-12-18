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

namespace Http\Ctrl;

use Core\Ctrl;
use Core\View;
use Core\Session;
use Model\UserModel;
use Core\Request;
use Http\Request\LoginRequest;

class loginCtrl extends Ctrl
{
   
    public function do()
    {
        $request = new LoginRequest();
        $credentials = $request->Validate($request->rules());

        // If validation fails, $credentials will be empty
        if (empty($credentials)) 
        {
            Session::FlashValidationState($request->GetErrors(), $request->GetAllPost());
            $this->redirect('/login');
        }

        if ((new UserModel)->Login($credentials['email'], $credentials['password'])) 
        {
            // On successful login, regenerate session ID to prevent session fixation
            session_regenerate_id(true);
            Session::Set('valid_user', true);
            $this->redirect('/dashboard');
        }

        // Handle failed login (wrong credentials)
        Session::FlashValidationState(['general' => [__('login.error')]], $request->GetAllPost());
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
