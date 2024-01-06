<?php

class PageRouter {
    private $routes;

    public function __construct($routes) {
        $this->routes = $routes;
    }

    public function route($path, $method) {
        $path = explode("?", $path)[0];
        foreach ($this->routes as $key => $value) {
            $match = $this->match($path, $key);
            $_GLOBALS["__params"] = $match[1];
            if ($match[0]) {
                require $_ENV['PWD'] . "/app/" . $value;
                exit();
            }
        }

        header("HTTP/1.0 404 Not Found");
    }

    public function match($path, $key) {
        $path = explode("/", $path);
        $key = explode("/", $key);
        
        if (count($path) != count($key)) {
            return [false, []];
        }

        $params = [];
        for ($i = 0; $i < count($path); $i++) {
            if ($key[$i] !== "*" && $key[$i] !== $path[$i]) {
                return [false, []];
            } else if ($key[$i] != $path[$i]) {
                $params[] = $path[$i];
            }
        }

        return [true, $params];
    }
}