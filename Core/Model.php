<?php

/**
 * Model
 * 
 * @category   Libs
 * @package    Mass-Symfonia
 * @author     Rafał Żygadło <rafal@maxkod.pl>

 * @copyright  2018 maxkod.pl
 * @version    1.0
 */


namespace Core;


class Model extends Database
{

    
    public function __construct()
    {   
        parent::__construct();
    }

    public function GetTitle()
    {
        throw new myException('NOT IMPLEMENTED', __FUNCTION__);
    }


    public function Update()
    {
        throw new myException('NOT IMPLEMENTED', __FUNCTION__);
    }

    public function CountAll()
    {
        return 0;
    }
    
}

