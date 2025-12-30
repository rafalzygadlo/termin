<?php

namespace Core;

use Config\System;

class Request
{
    protected array $routeParams = [];

    public function GetUri(): string
    {
        $uri = $_GET[System::URL] ?? '/';
        $uri = rtrim($uri, '/');
        $uri = filter_var($uri, FILTER_SANITIZE_URL);
        return $uri === '' ? '/' : $uri;
    }

    public function GetMethod(): string
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
     * Gets all POST data.
     * @return array
     */
    public function GetAllPost(): array
    {
        return $_POST;
    }

    /**
     * Sets the route parameters captured by the Router.
     */
    public function SetRouteParams(array $params): void
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
    public function GetParam(string $name, $default = null)
    {
        return $this->routeParams[$name] ?? $default;
    }
}