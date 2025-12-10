<?php

/**
 * Database
 * 
 * @category   Lib
 * @package    Mass-Symfonia
 * @author     Rafał Żygadło <rafal@maxkod.pl>

 * @copyright  2018 maxkod.pl
 * @version    1.0
 */


namespace Core;

use PDO;
use Config\Db;
class Database extends PDO
{

    private $sth;
    private PDO $pdo;
    
    public function __construct()
    {
        parent::__construct(Db::TYPE . ':host=' . Db::HOST . ';dbname=' . Db::NAME,  Db::USER, Db::PASSWORD);
        $this->exec('SET NAMES utf8');
    }

    public function FetchRow($sql,$params)
    {
        $this->sth = $this->prepare($sql);
        if ($this->sth)
        {
            if ($this->sth->execute($params))
            {                     
                $this->sth->setFetchMode(PDO::FETCH_OBJ);    
                return $this->sth->fetch();
            }
        }
        else
        {
            return false;
        }

    }

    public function Max($field,$table,$fetchMode = PDO::FETCH_CLASSTYPE)
    {
        $sql = "SELECT MAX($field) as Max FROM $table";

        $this->sth = $this->prepare($sql);
        if ($this->sth)
        {
            if ($this->sth->execute())
                return $this->sth->fetch($fetchMode);
        }
        else
        {
            return false;
        }

    }
    
    public function FetchQuery($sql, $params = null,$fetchMode = PDO::FETCH_OBJ)
    {
		
        $this->sth = $this->prepare($sql);
        if ($this->sth)
        {
            if ($this->sth->execute($params))
                return $this->sth->fetchAll($fetchMode);
        }
        else
        {
            return false;
        }
    }

    public function ExecuteQuery($sql, $params)
    {
 
        $this->sth = $this->prepare($sql);
        if ($this->sth)
        {
            if ($this->sth->execute($params))
                return true;
        }
        else
        {
            return false;
        }
    }
  
    
    public function RowCount()
    {
        return $this->sth->rowCount();
    }

    public function Count($sql, $params)
    {
        $this->sth = $this->prepare($sql);
        if( $this->sth ) 
        {       
            $this->sth->execute($params);
            return $this->sth->fetchColumn();
        }
        else
        {
            return false;
        }
        
    }
 


}
