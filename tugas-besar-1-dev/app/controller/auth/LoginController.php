<?php

require_once $_ENV['PWD'] . '/app/controller/BaseController.php';

class LoginController extends BaseController {
    protected static $instance;

    private function __construct($service) {
        parent::__construct($service);
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static(
                AuthService::getInstance()
            );
        }
        return self::$instance;
    }

    protected function post($urlParams) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $this->service->login($username, $password);
        
        return (new Response(true, "Login success", $user->getAssosiativeArray(), 200))->json();
    }

}