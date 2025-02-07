<?php
// app/core/Router.php

class Router {

    // Lista blanca de controladores y acciones permitidas
    private $allowedRoutes = [
        'clientes'  => ['index', 'crear', 'guardar', 'editar', 'actualizar', 'eliminar', 'cambiarEstado', 'inactivos'],
        'pedidos'   => ['index', 'crear', 'guardar', 'editar', 'actualizar', 'eliminar'],
        'productos' => ['index', 'crear', 'guardar', 'editar', 'actualizar', 'eliminar']
        // Puedes agregar más controladores y acciones aquí
    ];

    public function dispatch() {
        // Capturamos la URL amigable. Por ejemplo: clientes/editar/3
        $url = isset($_GET['url']) ? $_GET['url'] : '';
        $url = rtrim($url, '/');
        $urlParts = explode('/', $url);

        // Determinamos el nombre del controlador y la acción
        $controllerName = (isset($urlParts[0]) && !empty($urlParts[0])) ? strtolower($urlParts[0]) : 'default';
        $action = (isset($urlParts[1]) && !empty($urlParts[1])) ? $urlParts[1] : 'index';

        // Verificar que el controlador esté en la lista blanca
        if (!array_key_exists($controllerName, $this->allowedRoutes)) {
            $this->error404("Controlador no permitido: {$controllerName}");
        }

        // Verificar que la acción solicitada esté permitida para ese controlador
        if (!in_array($action, $this->allowedRoutes[$controllerName])) {
            $this->error404("Acción no permitida: {$action} en {$controllerName}");
        }

        // Construir la ruta del archivo del controlador.
        // Se asume que el controlador se llama con la primera letra en mayúscula y termina en "Controller.php"
        $controllerFile = __DIR__ . '/../controllers/web/' . ucfirst($controllerName) . 'Controller.php';
        if (!file_exists($controllerFile)) {
            $this->error404("Archivo del controlador no encontrado: {$controllerFile}");
        }
        require_once $controllerFile;

        // Instanciar la clase del controlador
        $controllerClass = ucfirst($controllerName) . 'Controller';
        if (!class_exists($controllerClass)) {
            $this->error404("Clase del controlador no existe: {$controllerClass}");
        }
        $controller = new $controllerClass();

        // Obtener los parámetros adicionales (por ejemplo, un ID u otros parámetros)
        $params = array_slice($urlParts, 2);

        // Verificar que el método (acción) exista en el controlador
        if (!method_exists($controller, $action)) {
            $this->error404("El método {$action} no existe en el controlador {$controllerClass}");
        }

        // Llamar al método con los parámetros (si los hay)
        call_user_func_array([$controller, $action], $params);
    }

    private function error404($message) {
        header("HTTP/1.0 404 Not Found");
        echo "<h1>404 Not Found</h1>";
        echo "<p>{$message}</p>";
        exit;
    }
}
