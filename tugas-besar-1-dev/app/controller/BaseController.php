<?php

abstract class BaseController {

    protected static $instance;
    protected $service;

    protected function __construct($service) {
        $this->service = $service;
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static(null);
        }
        return self::$instance;
    }

    protected function get($urlParams) {
        throw new MethodNotAllowed();
    }

    protected function post($urlParams) {
        throw new MethodNotAllowed();
    }

    protected function put($urlParams) {
        throw new MethodNotAllowed();
    }

    protected function delete($urlParams) {
        throw new MethodNotAllowed();
    }

    public function handle($method, $urlParams) {
        $method = strtolower($method);
        echo $this->$method($urlParams);
    }
}