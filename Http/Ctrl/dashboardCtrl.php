<?php

namespace Http\Ctrl;

use Core\Ctrl;
use Core\View;

class dashboardCtrl extends authCtrl
{
    
    public function index()
    {
        $view = new View();
        $view->Render('dashboard/index');
    }
}
