<?php

/**
 * userCtrl
 * 
 * @category   Controller
 * @package    CMS
 * @author     Rafał Żygadło <rafal@maxkod.pl>
 
 * @copyright  2016 maxkod.pl
 * @version    1.0
 */
// FORM user new,edit


namespace Http\Ctrl;


use Core\Ctrl;
use Core\Msg;
use Core\View;
use Model\userModel;


class userCtrl extends Ctrl 
{
    public function Index()
    {
        $view = new View();
        $view->render('user/index');    
    }   
}
