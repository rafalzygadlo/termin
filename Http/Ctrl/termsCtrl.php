<?php

/**
 * termsCtrl
 * 
 * @category   Controller
 * @package    CMS
 * @author     rafal zygadlo <rafal@maxkod.pl>
 
 * @copyright  2016 maxkod.pl
 * @version    1.0
 */

namespace Http\Ctrl;

use Core\Ctrl;
use Core\View;


class termsCtrl extends Ctrl 
{
    public function Index()
    {
        $view = new View();
        $view->render('terms');    
    }   
}
