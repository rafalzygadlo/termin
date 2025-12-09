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

class Database extends PDO
{

    private $sth;
    private PDO $pdo;
    
    public function __construct()
    {
        parent::__construct(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME,  DB_USER, DB_PASSWORD);
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
            //else
            //{
			//	throw new myException('DATABASE ERROR',$sql.'<br>'. $this->sth->errorInfo()[2]);
            //}
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
            //}else
            //{
			//	throw new myException('DATABASE ERROR',$sql.'<br>'. $this->sth->errorInfo()[2]);
            //}
        }
        else
        {
            return false;
        }

    }
    
    public function FetchQuery($sql, $params = null,$fetchMode = PDO::FETCH_OBJ)
    {
		
        $this->sth = $this->prepare($sql);
        //if ($this->sth)
        //{
            if ($this->sth->execute($params))
                return $this->sth->fetchAll($fetchMode);
            //else
				//throw new myException('DATABASE ERROR',$sql.'<br>'. $this->sth->errorInfo()[2]);
        //}
        //else
        //{
          //  return false;
        //}
    }

    public function FetchNonQuery($sql, $params)
    {
 
        $this->sth = $this->prepare($sql);
        if ($this->sth)
        {
            if ($this->sth->execute($params))
                return true;
           //else
             //   throw  new myException('DATABASE ERROR',$sql.'<br>'. $this->sth->errorInfo()[2]);
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
        $this->sth->execute($params);
        return $this->sth->fetchColumn();
    }
 


}
