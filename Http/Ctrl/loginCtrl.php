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
use Model\UserModel;
use Core\Request;

class loginCtrl extends Ctrl
{
   
    public function do(Request $request)
    {
        
        //check email

        //generate code
        //send email
        $request->Validate();
        $username = $request->Get('user');
        $password = $request->Get('password');
        (new UserModel)->Login($username, $password);   
        $this->redirect('/dashboard');
    }

    public function index()
    {	   
        $view = new View();
        $view->Render('login/index');
          
    }
    
}

