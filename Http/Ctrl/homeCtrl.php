<?php


namespace Http\Ctrl;

use Core\Ctrl;
use Core\View;

class homeCtrl extends Ctrl
{
    
    public function index()
    {
        $view = new View();
        $view->Render('home/index');
    }
}
