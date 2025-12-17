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
use Core\Email;
use Core\Checker\CheckerLogin;
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
            Session::flash('errors', $request->getErrors());
            Session::flash('old', $_POST);
            $this->redirect('/login');
        }

        if ((new UserModel)->Login($credentials['email'], $credentials['password'])) 
        {
            // On successful login, regenerate session ID to prevent session fixation
            session_regenerate_id(true);
            Session::set('valid_user', true);
            $this->Redirect('/dashboard');
        }

        // Handle failed login (wrong credentials)
        Session::flash('errors', ['general' => ['Nieprawidłowy email lub hasło.']]);
        Session::flash('old', $_POST);
        $this->redirect('/login');
    }

    public function index()
    {	   
        if(Session::get('valid_user', false)) 
        {
            $this->Redirect('/dashboard');
        }
        
        $errors = Session::getFlash('errors', []);
        $old = Session::getFlash('old', []);

        $view = new View('login/index', ['errors' => $errors, 'old' => $old]);
        $view->Render();
          
    }
    
}
