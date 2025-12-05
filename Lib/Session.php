<?php

 
namespace Lib;
 
class Session
{

    //GET

    public static function getCtrl()
    {
        if(isset($_SESSION['ctrl']))
            return $_SESSION['ctrl'];
        else
            return DEFAULT_CTRL;
    }

    public static function getLang()
    {
        if(isset($_SESSION['lang']))
            return $_SESSION['lang'];
        else{
         
         //print 'no lang';
          //e/xit;
            return 'pl';

        }
    }

    public static function getValidUser()
    {
        if(isset($_SESSION['valid_user']))
            return $_SESSION['valid_user'];
        else
            return false;
        
    }
    
    public static function getUser()
    {
        if(isset($_SESSION['user']))
            return $_SESSION['user'];
        else
            return false;
    }
    

    public static function setCtrl($value)
    {
        $_SESSION['ctrl'] = $value;
    }

    
    public static function setValidUser($value)    
    {
        $_SESSION['valid_user'] = $value;    
    }
    
    public static function setUser($value)
    {
        $_SESSION['user'] = $value;
    }
            
}
