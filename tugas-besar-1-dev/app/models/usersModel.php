<?php

require_once $_ENV['PWD'] . '/app/models/baseModel.php';

class usersModel extends baseModel{
    public $user_id;
    public $username;
    public $password;
    public $profile_picture;
    public $isadmin;

    public function __construct(){
        parent::__construct();
        $this->primaryKey='user_id';
    }

    public function populateFromAssosiativeArr($arr){
        $this->user_id = $arr['user_id'];
        $this->username = $arr['username'];
        $this->password = $arr['password'];
        $this->profile_picture = $arr['profile_picture'];
        $this->isadmin = $arr['is_admin'];
    }

    public function getAssosiativeArray(){
        $arr = array(
            'user_id' => $this->user_id,
            'username' => $this->username,
            'password' => $this->password,
            'profile_picture' => $this->profile_picture,
            'isadmin' => $this->isadmin
        );
        return $arr;
    }
}

?>