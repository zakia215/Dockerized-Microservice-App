<?php

require_once $_ENV['PWD'] . '/app/controller/BaseController.php';
require_once $_ENV['PWD'] . '/app/service/AuthService.php';
require_once $_ENV['PWD'] . '/app/response/Response.php';

class SignupController extends BaseController {
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

    public function post($urlParams) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm-password'];
        $profilePic = $_POST['profile-picture'];
        $isAdmin = $_POST['is-admin'];

        $user = $this->service->addNewUser($username, $password, $confirmPassword, $profilePic, $isAdmin);

        return (new Response(true, "User created successfully", $user->getAssosiativeArray(), 200))->json();
    }
}