<?php

namespace Core\Checker;

use Core\Request;
use Core\Checker;
use Core\Session;

class CheckerLogin extends Checker
{
  
    public function Run(Request $request)
    {         
        if(Session::get('valid_user'))
            return; // User is valid, do nothing.

        header('location: /login');
        exit; // Stop script execution immediately after redirect.
    }

}
