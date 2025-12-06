<?php

/**
 * countryModel
 * 
 * @category   Model
 * @package    Mass-Symfonia
 * @author     Rafał Żygadło <rafal@maxkod.pl>

 * @copyright  2018 maxkod.pl
 * @version    1.0
 */

 namespace Model;
 
 use Core\Model;
 use Core\FileLog;
 use PDO;
 
class RegisterModel extends Model
{
	protected $table = "user";
    
	function __construct()
    {  
        parent::__construct();  
    }
	 

    public function Exists($column, $value)
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$column} = ?";
		$result = $this->FetchRow($sql, [$value]);
        return $this->RowCount();

    }

    public function CreateUser($email, $password)
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO {$this->table} (email, password) VALUES (?, ?)";
        return $this->NonQuery($sql, [$email, $hash]);
    }

}
