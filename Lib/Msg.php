<?php

namespace Lib;

class Msg 
{

    private static $msg;

    public static function init()
    {
        //todo session switch
        $lang = \Lib\Session::getLang();
        self::$msg = json_decode(file_get_contents("Lang/$lang.json"), true);
    }

    public static function get($const)
    {
        if(array_key_exists($const,self::$msg))
            return self::$msg[$const];
        else
            return $const.'*';        
    }

}
