<?php

/*
 *  
 *   profileCtrl.php
 *   
 *   @category   Controller
 *   @package    Core
 *   @author     rafal zygadlo rafal@zygadlo.org
 *   @copyright  Copyright (c) 2025 zygadlo.org
 *   @license    MIT
 *  
 */




namespace Http\Ctrl;

use Core\View;

class profileCtrl extends authCtrl 
{
    public function index()
    {
        $view = new View();
        $view->render('profile/index');    
    }   

}
