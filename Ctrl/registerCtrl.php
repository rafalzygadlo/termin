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

use Lib\Ctrl;
use Lib\Tool;
use Model\Register\registerModel;
use Repository\registerRepository;

class registerCtrl extends Ctrl
{
  
    public function readData($model)
    {
        $data = json_decode(file_get_contents("php://input"));
        if($data)
        {
            $model->getEmail()->setValue($data->email);
            $model->getPassword()->setValue($data->password);
        }
    }

    
    public function insert($model, $key)
    {
        $repo = new registerRepository();
        $repo->registerUser($model,$key);
        
    }
 
    public function sendEmail($to,$key)
    {
        $email = new \Lib\Email();
        $email->SendActivationLink($to, $key);
    }
    
    /*
     * Endpoint register/confirm
     * 
     */
    public function confirm()
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
    public function index()
    {
      
        $model = new registerModel();
        $this->readData($model);
             
        $model->getEmail()->getValue();
                
      
        $validator = new \Lib\Validator();
        $validator->add($model->getEmail());
        $validator->add($model->getPassword());
        
        if($validator->run())
        {
            $key = Tool::RandomString(64);
            $this->insert($model, $key);
            $this->sendEmail($model->getEmail()->getValue(), $key);
            print json_encode(array("valid" => true,"message" =>"registered"));
        }
        else
        {
            $validator->JSON();
        }
        
    }


}
