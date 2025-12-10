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
use Core\Email;
use Core\Checker\CheckerLogin;
use Repository\userRepository;

class loginCtrl extends Ctrl
{
   
    public function Do(Request $request)
    {
        
        //check email

        //generate code
        //send email
        $username = $request->Get('user');
        $password = $request->Get('password');
        UserModel->Login($username, $password);   
        $view = new View();
        $view->Render('login/code');
    }

    public function Index()
    {	   
        $view = new View();
        $view->Render('login/index');
          
    }
    
}

