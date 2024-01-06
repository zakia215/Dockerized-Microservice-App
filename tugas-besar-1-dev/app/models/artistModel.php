<?php

require_once $_ENV['PWD'] . '/app/models/baseModel.php';

class artistModel extends baseModel{
    public $artist_id;
    public $name;
    public $profile_picture;
    public $username;
    public $email;
    public $password;
    public function __construct()
    {
        parent::__construct();
        $this->primaryKey = 'artist_id';
    }

    public function populateFromAssosiativeArr($arr)
    {
        $this->artist_id = $arr['artist_id'];
        $this->name = $arr['name'];
        $this->profile_picture = $arr['profile_picture'];
    }

    public function getAssosiativeArray(){
        $arr = array(
            'artist_id' => $this->artist_id,
            'name' => $this->name,
            'profile_picture' => $this->profile_picture,
        );
        return $arr;
    }
}
   


?>