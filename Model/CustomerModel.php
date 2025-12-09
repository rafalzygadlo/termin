<?php

/**
 * orderModel
 * 
 * @category   Model
 * @package    Mass-Symfonia
 * @author     Rafał Żygadło <rafal@maxkod.pl>

 * @copyright  2018 maxkod.pl
 * @version    1.0
 */

 namespace Model;
 
 use Core\Model;
 use PDO;
 
class CustomerModel extends Model
{
    
    function __construct()
    {  
        parent::__construct();  
    }
    
    public function All()
    {
        $sql = "SELECT * FROM customers";
        return $this->FetchQuery($sql);
    }

}
