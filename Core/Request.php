<?php

namespace Core;

use Config\System;

class Request
{
    protected ?Validator $validator = null;
    protected array $routeParams = [];

    public function getUri(): string
    {
        $uri = $_GET[System::URL] ?? '/';
        $uri = rtrim($uri, '/');
        $uri = filter_var($uri, FILTER_SANITIZE_URL);
        return $uri === '' ? '/' : $uri;
    }

    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function Get(string $key, $default = null)
    {
        return $_GET[$key] ?? $default;
    }

    public function Post(string $key, $default = null)
    {
        return $_POST[$key] ?? $default;
    }

    /**
     * Sets the route parameters captured by the Router.
     */
    public function setRouteParams(array $params): void
    {
        $this->routeParams = $params;
    }

    /**
     * Gets a route parameter by its name.
     * e.g., for a route /user/edit/{id}, getParam('id') will return the value.
     *
     * @param string $name The name of the parameter.
     * @param mixed $default The default value if the parameter doesn't exist.
     */
    public function getParam(string $name, $default = null)
    {
        return $this->routeParams[$name] ?? $default;
    }

    public function Validate(array $rules): array
    {
        // Pass a new Database instance to the validator
        $this->validator = new Validator($_POST, $rules, new Database());

        if (!$this->validator->run()) 
        {
            // In case of a validation error, we can throw an exception that can be caught in the controller
            // or in a global error handler to redirect the user back.
            // For now, we'll return an empty array, but throwing an exception is a better practice.
            return [];
        }

        return $this->validator->Validated();
    }

    public function GetErrors(): array
    {
        return $this->validator ? $this->validator->errors : [];
    }
}