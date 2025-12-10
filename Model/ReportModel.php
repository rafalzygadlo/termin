<?php

/**
 * reportModel
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
 
class ReportModel extends Model
{
    public $date;
    private $sql;
        
    public function GetId()
    {
        return $this->id;
    }
    
    public function GetName()
    {
        return $this->name;
    }
    
    public function Insert()
    {
        $params = array
        (
          ':date'  => $this->date
        );
      
        $sql = 'INSERT INTO maxkod_report SET date=:date';
        return $this->DB->NonMyQuery($sql, $params, PDO::FETCH_CLASS, __CLASS__);
      
    }
    
}
