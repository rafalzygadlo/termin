<?php

namespace Ctrl;

use Core\Ctrl;
use Core\Checker\CheckerLogin;
use Core\Session;


class authCtrl extends Ctrl
{
    public function __construct()
    {
    	$this->AddChecker(new CheckerLogin);
        
    }

}

    

