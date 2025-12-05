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


namespace Ctrl;


use Lib\Ctrl;
use Lib\Msg;
use Lib\View;
use Model\userModel;


class userCtrl extends Ctrl 
{
    public function index()
    {
        $view = new View();
        $view->render('user/index');    
    }   
}
