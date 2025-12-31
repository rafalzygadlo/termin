<?php

/**
 * logoutCtrl
 * 
 * @category   Controller
 * @package    CMS
 * @author     Rafał Żygadło <rafal@maxkod.pl>
 
 * @copyright  2016 maxkod.pl
 * @version    1.0
 */

namespace Ctrl;

use Core\Ctrl;
use Core\Session;
use Core\Request;
use Config\System;
class logoutCtrl extends Ctrl
{

    
    public function index()
    {
        session_destroy();
        unset($_SESSION);
        $cookies = $_COOKIE;

	    foreach($cookies as $cookie )
        {
            unset($cookie); 
        }

	    Session::set('valid_user', false);

        header('Location:'.System::DEFAULT_CTRL);

    }

}

