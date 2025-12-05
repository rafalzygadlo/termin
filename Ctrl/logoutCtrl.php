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

use Lib\Ctrl;

class logoutCtrl extends Ctrl
{

    public function __construct()
    {
        parent::__construct(false);
    }

    //public function method()
    //{
    //    $this->Index();
    //}

    public function index()
    {
        session_destroy();
        unset($_SESSION);
        $cookies = $_COOKIE;

	foreach($cookies as $cookie )
        {
            unset($cookie); 
        }

	$_SESSION[LOGIN_EMAIL] = '';
	$_SESSION[LOGIN_PASSWORD] = '';
        setcookie(LOGIN_EMAIL, '', time());
        setcookie(LOGIN_PASSWORD,'',time());

        header('Location:'.$this->getDefaultCtrl());

    }

}

