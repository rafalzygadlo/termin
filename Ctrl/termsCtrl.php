<?php
/*
 *  
 *   termsCtrl.php
 *   
 *   @category   Controller
 *   @package    Core
 *   @author     rafal zygadlo rafal@zygadlo.org
 *   @copyright  Copyright (c) 2025 zygadlo.org
 *   @license    MIT
 *  
 */


namespace Ctrl;

use Core\Ctrl;

use Core\View;


class termsCtrl extends Ctrl 
{
    public function index()
    {
        $view = new View();
        $view->render('terms');    
    }   
}
