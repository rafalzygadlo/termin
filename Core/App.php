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
use Core\Router;
use Core\View;
use Core\Request;

class App
{
    protected Request $request;

    public function Run($routes)
    {
        $this->request = new Request();
        $router = new Router($routes);

        $matchedRoute = $router->match($this->request);

        if ($matchedRoute) {
            // Set the captured route parameters on the request object
            $this->request->setRouteParams($matchedRoute['params']);
            $this->LoadController($matchedRoute['controller'], $matchedRoute['action']);
        } else {
            $this->LoadErrorController();
        }
    }

    private function LoadController(string $controllerClass, string $actionName)
    {
        if (!class_exists($controllerClass)) 
        {
            $this->LoadErrorController();
            return;
        }
     
        $controller = new $controllerClass;

        if (method_exists($controller, $actionName)) 
            // Call the Run method on the controller, which executes checkers and then the action.
            $controller->Run($actionName, $this->request);
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
