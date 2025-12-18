<?php

namespace Core;

class Router
{
    protected array $routes;

    /**
     * Router constructor.
     * @param array $routes The routes configuration array.
     */
    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    /**
     * Matches the request against the defined routes.
     * @param Request $request
     * @return array|null The matched route details or null if no match is found.
     */
    public function Match(Request $request): ?array
    {
        $uri = $request->GetUri();
        $method = $request->GetMethod();

        if (!isset($this->routes[$method])) {
            return null;
        }

        foreach ($this->routes[$method] as $routePath => $handler) 
        {
            // Convert route path with placeholders like {id} to a regex
            $routeRegex = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[^/]+)', $routePath);
            $routeRegex = '#^' . $routeRegex . '$#';

            $matches = [];
            if (preg_match($routeRegex, $uri, $matches)) 
            {
                $params = [];
                // Extract named parameters
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $params[$key] = $value;
                    }
                }

                [$controller, $action] = $handler;
                return [
                    'controller' => $controller,
                    'action' => $action,
                    'params' => $params,
                ];
            }
        }

        return null; // No match found after checking all routes.
    }
}