<?php

namespace Core;

class Msg 
{

    private static $msg;

    public static function Init()
    {
        //todo session switch
        $lang = \Core\Session::getLang();
        self::$msg = require("Lang/$lang.php");
    }

    public static function Get($const)
    {
        
        if(array_key_exists($const,self::$msg))
            return self::$msg[$const];
        else
            return '_'.$const.'_';        
    }

}
