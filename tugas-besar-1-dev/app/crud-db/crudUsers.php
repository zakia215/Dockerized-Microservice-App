<?php

require_once $_ENV['PWD'] . '/app/crud-db/crudBase.php';
require_once $_ENV['PWD'] . '/app/models/usersModel.php';

class crudUsers extends crudBase{
    public function __construct(){
        parent::__construct();
        $this->tableName  = 'users';
    }

    public static function getInstance(){
        if(!isset(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function getUserByUserID($user_id) {
        $sql_query = "SELECT * FROM users WHERE user_id = :user_id";
        $prepared_query = $this->pdo->prepare($sql_query);
        $prepared_query->bindValue(":user_id", $user_id, PDO::PARAM_INT);
        $prepared_query->execute();
        return $prepared_query->fetch();
    }

    public function getUserByUsername($username){
        $sql_query = "SELECT * from users WHERE username = :username";
        $prepared_query = $this->pdo->prepare($sql_query);
        $prepared_query->bindValue(":username", $username, PDO::PARAM_STR);
        $prepared_query->execute();
        return $prepared_query->fetch();
    }
    
    public function insertNewUser($user) {
        $sql_query = "INSERT INTO users (username, password, profile_picture, is_admin) VALUES (:username, :password, :profile_picture, :is_admin)";
        $prepared_query = $this->pdo->prepare($sql_query);
        $prepared_query->bindValue(':username', $user->get('username'));
        $prepared_query->bindValue(':password', $user->get('password'));
        $prepared_query->bindValue(':profile_picture', $user->get('profile_picture'));
        $prepared_query->bindValue(':is_admin', $user->get('isadmin'), PDO::PARAM_BOOL);
        $prepared_query->execute();

        return $this->pdo->lastInsertId();
    }

    public function deleteUser($user_id){
        $sql_query = "DELETE FROM users WHERE user_id = :user_id";
        $prepared_query = $this->pdo->prepare($sql_query);
        $prepared_query->bindValue(":user_id", $user_id, PDO::PARAM_STR);
        $prepared_query->execute();
        return $user_id;
    }

    public function updateUser($user_id, $username, $password, $profilePicture) {
        $sql_query = "UPDATE users";
        $count = 0;

        if ($username != '') {
            $sql_query .= " SET username = :username";
            $count++;
        }

        if ($password != "") {
            if ($count > 0){
                $sql_query .= ", ";
            } else {
                $sql_query .= " SET ";
            }
            $sql_query .= "password = :password";
            $count++;
        }

        if ($profilePicture != "") {
            if ($count > 0){
                $sql_query .= ", ";
            } else {
                $sql_query .= " SET ";
            }
            $sql_query .= "profile_picture = :profilePicture";
            $count++;
        }

        $sql_query .= " WHERE user_id = $user_id";
        $prepared_query = $this->pdo->prepare($sql_query);

        // Bind the values
        if ($username != "") {
            $prepared_query->bindValue(':username', $username, PDO::PARAM_STR);
        }
        if ($password != "") {
            $prepared_query->bindValue(':password', $password, PDO::PARAM_STR);
        }
        if ($profilePicture != "") {
            $prepared_query->bindValue(':profilePicture', $profilePicture, PDO::PARAM_STR);
        }

        $prepared_query->execute();
        return $user_id;
    }

}

?>