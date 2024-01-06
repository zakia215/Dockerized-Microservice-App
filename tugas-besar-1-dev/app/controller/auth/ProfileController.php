<?php

require_once $_ENV['PWD'] . '/app/controller/BaseController.php';
require_once $_ENV['PWD'] . '/app/service/UserService.php';
require_once $_ENV['PWD'] . '/app/response/Response.php';
require_once $_ENV['PWD'] . '/app/exceptions/BadRequest.php';

class ProfileController extends BaseController{
    protected static $instance;

    private function __construct($service) {
        parent::__construct($service);
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static(
                UserService::getInstance()
            );
        }
        return self::$instance;
    }
    public function delete($urlParams){
        print_r($urlParams);
        $user_id = $urlParams[0];
        $res = $this->service->deleteUser($user_id);
        $response = (new Response(true, $res, "successfully deleted", 200))->json();
        return $response;
    }

    public function put($urlParams) {

        parse_str(file_get_contents('php://input'), $_PUT);

        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
        } else {
            throw new BadRequest();
        }
        $username = '';
        $password = '';
        $profilePicture = '';

        if (isset($_PUT['username'])) {
            $username = $_PUT['username'];
        }

        if (isset($_PUT['password'])) {
            $password = password_hash($_PUT['password'], PASSWORD_DEFAULT);
        }

        if (isset($_PUT['profile-picture'])) {
            $profilePicture = $_PUT['profile-picture'];
        }

        $res = $this->service->editUser($user_id, $username, $password, $profilePicture);
        $response = (new Response(true, "successfully updated", $res, 200))->json();

        $_SESSION['profile_picture'] = $res->get('profile_picture');
        $_SESSION['username'] = $res->get('username');

        return $response;
    }

}

?>