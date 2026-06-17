<?php
// core/Router.php

class Router {
    private $routes = [];

    /**
     * Registra uma rota GET
     */
    public function get($path, $handler) {
        $this->routes['GET'][$path] = $handler;
    }

    /**
     * Registra uma rota POST
     */
    public function post($path, $handler) {
        $this->routes['POST'][$path] = $handler;
    }

    /**
     * Despacha a requisição para o handler correto
     */
    public function dispatch($uri, $method) {
        // Remove query string da URI
        $path = parse_url($uri, PHP_URL_PATH);

        // Garante que o caminho comece com '/'
        if (empty($path) || $path[0] !== '/') {
            $path = '/' . $path;
        }

        // Normaliza o caminho (remove a barra final se existir, a menos que seja a raiz '/')
        if ($path !== '/') {
            $path = rtrim($path, '/');
        }

        // Verifica se a rota existe para o método solicitado
        if (isset($this->routes[$method][$path])) {
            $handler = $this->routes[$method][$path];
            
            // Suporta formato 'Controller@method'
            if (is_string($handler) && strpos($handler, '@') !== false) {
                list($controllerName, $methodName) = explode('@', $handler);
                
                $controllerClass = $controllerName;
                if (!class_exists($controllerClass)) {
                    throw new Exception("Controller {$controllerClass} não encontrado.");
                }
                
                $controller = new $controllerClass();
                if (!method_exists($controller, $methodName)) {
                    throw new Exception("Método {$methodName} não encontrado no controller {$controllerClass}.");
                }
                
                return $controller->$methodName();
            }
            
            // Suporta closures
            if (is_callable($handler)) {
                return $handler();
            }
        }

        // 404 Not Found
        http_response_code(404);
        echo "<h1>404 - Página não encontrada</h1>";
        echo "<p>A rota <strong>{$path}</strong> não existe neste sistema.</p>";
        echo '<a href="/">Voltar para Início</a>';
    }
}
