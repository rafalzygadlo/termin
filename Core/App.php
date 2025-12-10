<?php

/**
 * Bootstrap
 * 
 * @category   Libs
 * @package    CMS
 * @author     Rafał Żygadło <rafal@maxkod.pl>
 
 * @copyright  2016 maxkod.pl
 * @version    1.0
 */
namespace Core;

use Config\System;
use Core\View;

class App
{
    public function Run()
    {
        $request = new Request();
        $this->LoadController($request);
    }

    private function CheckCtrlFile(string $controllerName): bool
    {
        $filename = System::CTRL_FOLDER . '/' . $controllerName . System::CTRL_SUFFIX . '.php';
        return file_exists($filename);
    }

    private function LoadController(Request $request)
    {
        if (!$this->CheckCtrlFile($request->controllerName)) {
            $this->LoadErrorController();
            return;
        }

        $ctrl = str_replace("/", "\\", $request->controllerName);
        $classname = System::CTRL_FOLDER . '\\' . $ctrl . System::CTRL_SUFFIX;
        $class = new $classname;

        $action = $request->actionName;

        if (method_exists($class, $action)) {
            $class->Run($action, $request);
        } else {
            $this->LoadErrorController();
        }
    }

    private function LoadErrorController()
    {
        $view = new View('errors/404', array(), false, 'errors/_layout.html');
        $view->Render();
        exit;
    }
}
