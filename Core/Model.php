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


abstract class Model
{
    protected Database $db;

    public function __construct()
    {
        $this->db = Database::instance();
    }
}
