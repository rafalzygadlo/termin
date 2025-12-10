<?php

/**
 * alterCtrl
 * 
 * @category   Ctrl
 * @package    Mass-Symfonia
 * @author     Rafał Żygadło <rafal@maxkod.pl>

 * @copyright  2020 maxkod.pl
 * @version    1.0
 */


namespace Ctrl;

use Core\Ctrl;
use Core\View;
use Core\Request;

class homeCtrl extends authCtrl
{
    
    public function edit(Request $request)
    {
        $view = new View();
        $view->Render('home/index');
    }
    
    
    public function Index()
    {
        $view = new View();
        $view->Render('home/index');
    }
}
