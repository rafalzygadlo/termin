<?php

namespace Core;

class Msg 
{

    private static $msg;

    public static function Init()
    {
        //todo session switch
        // Use the new generic 'get' method with a default value
        $lang = \Core\Session::get('lang', 'en'); 
        self::$msg = require(__DIR__ . "/../Lang/$lang.php");
    }

    public static function Get($const)
    {
        
        if(array_key_exists($const,self::$msg))
            return self::$msg[$const];
        else
            return '_'.$const.'_';        
    }

}
