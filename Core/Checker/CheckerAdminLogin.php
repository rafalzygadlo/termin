<?php

namespace Core\Checker;

use Core\Request;
use Core\Checker;

class CheckerAdminLogin extends Checker
{
  
    public function Run(Request $request)
    {
        //print "Checker AdminLogin Run\n";
        //$user = new \Model\UserModel();
        //print_r($user->GetAll());
        
        header('location: /login');   
        
           		
    }

}
