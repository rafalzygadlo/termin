<?php

 
namespace Core;
 
class Session
{

    //GET

    public static function GetCtrl()
    {
        if(isset($_SESSION['ctrl']))
            return $_SESSION['ctrl'];
        else
            return DEFAULT_CTRL;
    }

    public static function GetLang()
    {
        if(isset($_SESSION['lang']))
            return $_SESSION['lang'];
        else{
         
         //print 'no lang';
          //e/xit;
            return 'en';

        }
    }

    public static function GetValidUser()
    {
        if(isset($_SESSION['valid_user']))
            return $_SESSION['valid_user'];
        else
            return false;
        
    }
    
    public static function GetUser()
    {
        if(isset($_SESSION['user']))
            return $_SESSION['user'];
        else
            return false;
    }
    

    public static function SetCtrl($value)
    {
        $_SESSION['ctrl'] = $value;
    }

    
    public static function SetValidUser($value)    
    {
        $_SESSION['valid_user'] = $value;    
    }
    
    public static function SetUser($value)
    {
        $_SESSION['user'] = $value;
    }
            
}
