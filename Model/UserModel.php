<?php

/**
 * UserModel
 * 
 * @category   Model
 * @package    Termin
 * @author     rafal zygadlo <rafal@maxkod.pl>

 * @copyright  2018-2025 maxkod.pl
 * @version    1.0
 */

 namespace Model;
 
 use Core\Model;
 
class UserModel extends Model
{
	protected $table = "user";
    
    public function Login($username, $password)
    {
        $sql = "SELECT * FROM {$this->table} WHERE email=:email AND password=:password LIMIT 1";
        $result = $this->db->FetchQuery($sql, ['email' => $username, 'password' => md5($password)]);
        
        if(count($result) > 0)
            return $result;
        else   
            return false;
        
    }  

    public function GetAll()
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->db->FetchQuery($sql);
    }

}
