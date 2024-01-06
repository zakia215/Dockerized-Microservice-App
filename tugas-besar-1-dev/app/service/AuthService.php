<?php

require_once $_ENV['PWD'] . '/app/service/BaseService.php';
require_once $_ENV['PWD'] . '/app/service/UserService.php';
require_once $_ENV['PWD'] . '/app/models/usersModel.php';
require_once $_ENV['PWD'] . '/app/db/database.php';
require_once $_ENV['PWD'] . '/app/exceptions/BadRequest.php';
require_once $_ENV['PWD'] . '/app/exceptions/MethodNotAllowed.php';

class AuthService extends BaseService {

    protected static $instance;
    private $userService;

    private function __construct() {
        parent::__construct();
        $this->userService = UserService::getInstance();
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static(null);
        }
        return self::$instance;
    }

    public function addNewUser($username, $password, $confirmPassword, $profile_pic, $is_admin) {
        // Check if password match
        if ($password != $confirmPassword) {
            throw new BadRequest("Password does not match");
        }

        $user = $this->userService->registerUser($username, $password, $is_admin, $profile_pic);
        return $user;
    }


    public function login($username, $password) {
        $user = $this->userService->getUserByUsername($username);
        if ($user == null) {
            throw new BadRequest("User not found");
        }
        if (!password_verify($password, $user->get('password'))) {
            throw new BadRequest("Wrong password");
        }
        $_SESSION['user_id'] = $user->get('user_id');
        $_SESSION['username'] = $user->get('username');
        $_SESSION['is_admin'] = $user->get('isadmin');
        $_SESSION['profile_picture'] = $user->get('profile_picture');

        return $user;
    }
    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['is_admin']);
        unset($_SESSION['profile_picture']);
    }

}