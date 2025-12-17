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


namespace Http\Ctrl;

use Core\Ctrl;
use Core\View;

class homeCtrl extends Ctrl
{
    
    public function index()
    {
        $view = new View();
        $view->Render('dashboard/index');
    }
}
