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
 use Core\FileLog;
 use PDO;
 
class UserModel extends Model
{
	protected $table = "user";
    
	function __construct()
    {  
        parent::__construct();  
    }
	
    public function GetAll()
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->FetchQuery($sql);
    }

}
