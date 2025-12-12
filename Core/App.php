<?php

/**
 * Bootstrap
 * 
 * @category   Libs
 * @package    CMS
 * @author     rafal zygadlo <rafal@maxkod.pl>
 
 * @copyright  2016 maxkod.pl
 * @version    1.0
 */
namespace Core;

use Config\System;
use Core\View;
use Core\Request;
class App
{
    protected string $controllerClass;
    protected string $actionName;
    protected Request $request;

    public function Run()
    {
        $this->request = new Request();
        $this->actionName = $this->request->actionName;
        $ctrlFolder = str_replace("/", "\\", System::CTRL_FOLDER);
        $this->controllerClass = $ctrlFolder . '\\' . str_replace("/", "\\", $this->request->controllerName) . System::CTRL_SUFFIX;
        
        $this->LoadController($this->request);
    }

    private function LoadController(Request $request)
    {
        
        if (!class_exists($this->controllerClass)) 
        {
            $this->LoadErrorController();
            return;
        }
     
        $controller = new $this->controllerClass;

        if (method_exists($controller, $this->actionName)) 
           $controller->Run($this->actionName, $this->request);
         else 
            $this->LoadErrorController();
    }

    private function LoadErrorController()
    {
        $view = new View('errors/404', array(), false, 'errors/_layout.html');
        $view->Render();
        exit;
    }
}
