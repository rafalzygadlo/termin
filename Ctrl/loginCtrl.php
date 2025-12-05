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

use Lib\Ctrl;
use Lib\View;
use Lib\Email;
use Lib\Checker\CheckerLogin;
use Repository\userRepository;

class loginCtrl extends Ctrl
{
    public function __construct()
    {
        //$this->Email = new Email();
    }

    public function do()
    {
        
        //check email

        //generate code
        //send email
        
        $view = new View();
        $view->render('login/code1');
    }

    public function index()
    {	   
        $view = new View();
        $view->render('login/index');
          
    }
    
}

