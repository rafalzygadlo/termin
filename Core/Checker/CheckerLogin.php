<?php

namespace Core\Checker;

use Core\Checker;

class CheckerLogin extends Checker
{
  
    public function Run($request)
    {
        
         
        $user = new \Model\UserModel();
        $all = $user->GetAll();

        foreach($all as $u)
        {               
            print($u->email);
            print("<br>");
        };
         
           		
    }

}
