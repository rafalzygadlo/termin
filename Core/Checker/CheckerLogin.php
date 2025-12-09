<?php

namespace Core\Checker;

use Core\Checker;

class CheckerLogin extends Checker
{
  
    public function Run($request)
    {
        print "CheckerLogin Run\n";
        $user = new \Model\UserModel();
        print_r($user->GetAll());
        
        # header('location: /login');   
        
           		
    }

}
