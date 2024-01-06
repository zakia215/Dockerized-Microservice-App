<?php

require_once $_ENV['PWD'] . '/app/service/BaseService.php';
require_once $_ENV['PWD'] . '/app/models/usersModel.php';
require_once $_ENV['PWD'] . '/app/exceptions/BadRequest.php';
require_once $_ENV['PWD'] . '/app/crud-db/crudUsers.php';

class UserService extends BaseService {
    protected static $instance;

    private function __construct() {
        parent::__construct();
        $this->repo = crudUsers::getInstance();
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static(null);
        }
        return self::$instance;
    }

    public function registerUser($username, $password, $isAdmin, $profilePic) {
        // Bind values to model
        $userModel = new usersModel();
        $userModel->set('username', $username);
        $userModel->set('password', $password);
        $userModel->set('isadmin', $isAdmin);
        $userModel->set('profile_picture', $profilePic);

        $userModel->set('password', password_hash($password, PASSWORD_DEFAULT));

        // Insert into database
        $id = $this->repo->insertNewUser($userModel);

        // return result
        $queryResult = $this->repo->getUserByUserID($id);
        $newUser = new usersModel();
        $newUser->populateFromAssosiativeArr($queryResult);

        // print_r($_SESSION);

        // return the result
        return $newUser;
    }

    public function getUserByUsername($username) {
        $queryResult = $this->repo->getUserByUsername($username);
        if ($queryResult == null) {
            return null;
        }
        $user = new usersModel();
        $user->populateFromAssosiativeArr($queryResult);
        return $user;
    }

    public function getUserByUserID($userID) {
        $queryResult = $this->repo->getUserByUserID($userID);
        if ($queryResult == null) {
            return null;
        }
        $user = new usersModel();
        $user->populateFromAssosiativeArr($queryResult);
        return $user;
    }
    public function deleteUser($user_id){
        return $this->repo->deleteUser($user_id);
    }

    public function editUser($user_id, $username, $password, $profilePicture) {
        $user_id = $this->repo->updateUser($user_id, $username, $password, $profilePicture);
        $queryResult = $this->repo->getUserByUserID($user_id);
        $user = new usersModel();
        $user->populateFromAssosiativeArr($queryResult);
        return $user;
    }

}