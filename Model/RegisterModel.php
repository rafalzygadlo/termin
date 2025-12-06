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
	protected $table = "users";
    
	function __construct()
    {  
        parent::__construct();  
    }
	 

    public function Exists($column, $value)
    {
        $sql = "SELECT COUNT(*) FROM {$this->table} WHERE {$column} = ?";
		$this->fetchRow($sql, [$value]); 
        return  0;
    }

    public function CreateUser($email, $password)
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO {$this->table} (email, password) VALUES (?, ?)";
        return $this->execute($sql, [$email, $hash]);
    }

}
