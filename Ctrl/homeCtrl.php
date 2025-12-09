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

class homeCtrl extends authCtrl
{
    public function Index()
    {
        $view = new View();
        $view->Render('home/index');
    }
}
