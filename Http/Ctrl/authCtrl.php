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

namespace Ctrl;

use Core\Ctrl;
use Core\Checker\CheckerLogin;


class authCtrl extends Ctrl
{
    public function __construct()
    {
    	$this->AddChecker(new CheckerLogin);
    }

}

    

