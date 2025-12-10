<?php

namespace Core\Checker;

use Core\Request;
use Core\Checker;
use Core\Session;

class CheckerLogin extends Checker
{
  
    public function Run(Request $request)
    {         
        if(Session::getValidUser())
            return;
        
        header('location: /login');
    }

}
