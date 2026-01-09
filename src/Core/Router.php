<?php
namespace Core;

class Router {
    private $Route = [];

    public function get($path, $controller)
    {
        $this->Route['GET'][$path] = $controller;
    }

    public function post($path, $controller)
    {
        $this->Route['POST'][$path] = $controller;
    }

    public function generate_path(): void
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        if(!isset($this->Route[$method][$path])) {
            require_once __DIR__ . "/../Views/404.php";
            return;
        }

        $action = $this->Route[$method][$path];
        list($controller_class, $method_part) = explode("@", $action);

        $full_class = '\\' . $controller_class; 
        $controller_obj = new $full_class();
        $controller_obj->$method_part();
    }
}
