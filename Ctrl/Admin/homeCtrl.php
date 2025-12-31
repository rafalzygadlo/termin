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


namespace Ctrl\Admin;

use Core\Ctrl;
use Ctrl\Admin\authCtrl;


class homeCtrl extends Ctrl
{
    public function index()
    {
        $view = new \View\Admin\homeView();
        $view->Render('admin/home/index');
    }
}
