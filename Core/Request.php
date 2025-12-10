<?php

namespace Core;

use Config\System;

class Request
{
    public string $controllerName;
    public string $actionName;
    public array $params = [];

    public function __construct()
    {
        $this->parseUrl();
    }

    private function parseUrl(): void
    {
        if (!isset($_GET[System::URL])) {
            $this->controllerName = System::DEFAULT_CTRL;
            $this->actionName = 'index';
            return;
        }

        $url = rtrim($_GET[System::URL], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $urlParts = explode('/', $url);

        // Find controller path
        $path = '';
        $pathParts = [];
        foreach ($urlParts as $part) 
        {
            $tempPath = $path . ucfirst($part);
            if (is_dir(System::CTRL_FOLDER . '/' . $tempPath)) 
            {
                $path = $tempPath . '/';
                $pathParts[] = $part;
            } else {
                break;
            }
        }
        
        $remainingParts = array_slice($urlParts, count($pathParts));
        
        // Controller
        if (isset($remainingParts[0]) && !empty($remainingParts[0])) {
            $this->controllerName = ltrim($path, '/') . $remainingParts[0];
        } else {
            // If the path points to a directory, but no controller is specified,
            // try to use the default controller within that directory.
            // e.g. /admin/ -> Admin/Index
            $this->controllerName = rtrim($path, '/') . System::DEFAULT_CTRL;
            // If the resulting controller file doesn't exist, it will be handled as a 404 by the Dispatcher.
            // This handles the case where a URL is just a directory name.
        }

        // Action
        if (isset($remainingParts[1]) && !empty($remainingParts[1])) {
            $this->actionName = $remainingParts[1];
        } else {
            $this->actionName = 'index';
        }

        // Params
        if (count($remainingParts) > 2) {
            $this->params = array_slice($remainingParts, 2);
        }
    }

    public function get(string $key, $default = null)
    {
        return $_GET[$key] ?? $default;
    }

    public function post(string $key, $default = null)
    {
        return $_POST[$key] ?? $default;
    }
}