<?php

/**
 * registerCtrl
 * 
 * @category   Controller
 * @package    CMS
 * @author     Rafał Żygadło <rafal@maxkod.pl>
 
 * @copyright  2016 maxkod.pl
 * @version    1.0
 */

namespace Ctrl;

use Core\Ctrl;
use Core\Tool;
use Model\RegisterModel;
use View\RegisterView;

class registerCtrl extends Ctrl
{
  
   
    
    public function Insert($model, $key)
    {
        $repo = new registerRepository();
        $repo->registerUser($model,$key);
        
    }
 
    public function SendEmail($to,$key)
    {
        $email = new \Core\Email();
        $email->SendActivationLink($to, $key);
    }
    
    /*
     * Endpoint register/confirm
     * 
     */
    public function Confirm()
    {
        $key = $_GET['key'];
        
        $model = new registerRepository();
        $model->confirmEmail($key);
        print 'email confirmed';
    }
    
    /*
     * Endpoint register
     * 
     */    
    public function Index()
    {
      
        $model = new RegisterModel();
        $model->exists('email', 'qotsa@op.pl');

        
    }


}
