<?php

namespace Core;

use Config\System;

class Request
{
    public string $controllerName;
    public string $actionName;
    public array $params = [];
    protected array $errors = [];
    public array $rules = [];


    public function __construct()
    {
        $this->ParseUrl();
    }

    private function ParseUrl(): void
    {
        if (!isset($_GET[System::URL])) 
        {
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
            } 
            else 
            {
                break;
            }
        }
        
        $remainingParts = array_slice($urlParts, count($pathParts));
        
        // Controller
        if (isset($remainingParts[0]) && !empty($remainingParts[0])) 
            $this->controllerName = ltrim($path, '/') . $remainingParts[0];
        else 
            $this->controllerName = rtrim($path, '/') . System::DEFAULT_CTRL;
        

        // Action
        if (isset($remainingParts[1]) && !empty($remainingParts[1])) 
            $this->actionName = $remainingParts[1];
        else 
            $this->actionName = 'index';
        

        // Params
        if (count($remainingParts) > 2) 
        {
            $this->params = array_slice($remainingParts, 2);
        }
    }

    public function Get(string $key, $default = null)
    {
        return $_GET[$key] ?? $default;
    }

    public function Post(string $key, $default = null)
    {
        return $_POST[$key] ?? $default;
    }

    public function Validate($rules): array|false 
    {
        print_r ($_POST);
        $validator = new Validator($_POST, $rules);

        if (!$validator->Run()) 
        {
            return false;
        }

        return $validator->Validated();
    }

    protected function AddError(string $field, string $message): void
    {
        $this->errors[$field][] = $message;
    }

    public function GetErrors(): array
    {
        return $this->errors;
    }


}