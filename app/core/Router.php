<?php

class Router {
    private $routes = [];

    // Add route to list
    public function add($method, $route, $handler) {
        // Convert route to regex. E.g., "/product/{slug}" -> "#^/product/(?P<slug>[^/]+)$#D"
        $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[^/]+)', $route);
        $pattern = '#^' . $pattern . '$#D';

        $this->routes[] = [
            'method' => strtoupper($method),
            'pattern' => $pattern,
            'handler' => $handler
        ];
    }

    // Resolve matching route
    public function dispatch($requestUri, $requestMethod) {
        // Strip query strings (e.g., /products?page=2 -> /products)
        $parsedUrl = parse_url($requestUri);
        $path = $parsedUrl['path'] ?? '/';
        $method = strtoupper($requestMethod);

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && preg_match($route['pattern'], $path, $matches)) {
                // Extract named parameters from the regex match
                $params = [];
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $params[$key] = $value;
                    }
                }
                
                // Call the controller action
                return $this->executeHandler($route['handler'], $params);
            }
        }

        // 404 Not Found
        $this->handleNotFound();
    }

    private function executeHandler($handler, $params) {
        if (is_callable($handler)) {
            return call_user_func_array($handler, $params);
        }

        if (is_string($handler)) {
            list($controllerName, $actionName) = explode('@', $handler);

            // Require controller file
            $controllerPath = __DIR__ . '/../controllers/' . $controllerName . '.php';
            if (file_exists($controllerPath)) {
                require_once $controllerPath;
                if (class_exists($controllerName)) {
                    $controller = new $controllerName();
                    if (method_exists($controller, $actionName)) {
                        return call_user_func_array([$controller, $actionName], $params);
                    }
                }
            }
        }

        $this->handleNotFound();
    }

    private function handleNotFound() {
        http_response_code(404);
        // Load custom 404 view if exists, otherwise display message
        $viewPath = __DIR__ . '/../views/404.php';
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            echo "<h1>404 Sayfa Bulunamadı</h1><p>Aradığınız sayfa MaxPerry mağazasında bulunmuyor.</p>";
        }
        exit;
    }
}
