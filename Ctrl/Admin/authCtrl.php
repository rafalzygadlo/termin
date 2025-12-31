<?php
/**
 * authCtrl
 * 
 * @category   Controller
 * @package    CMS
 * @author     rafal zygadlo
 
 * @copyright  2017-03-18 maxkod.pl
 * @version    1.0
 */

namespace Ctrl\Admin;

use Core\Ctrl;
use Core\Checker\CheckerAdminLogin;


class authCtrl extends Ctrl
{
    public function __construct()
    {
        parent::__construct("","","");
    	$this->AddChecker(new CheckerAdminLogin);
    }

}

    

