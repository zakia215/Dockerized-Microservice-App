<?php

require_once $_ENV['PWD'] . '/app/models/baseModel.php';

class SubscriptionModel extends baseModel
{
    public $creator_id;
    public $user_id;
    public $status;
    public $username;

    public function __construct()
    {
        parent::__construct();
        $this->primaryKey = 'creator_id';
    }

    public function populateFromAssosiativeArr($arr)
    {
        $this->creator_id = $arr['creator_id'];
        $this->user_id = $arr['user_id'];
        $this->status = $arr['status'];
        $this->username = $arr['username'];
    }

    public function getAssosiativeArray()
    {
        $arr = array(
            'creator_id' => $this->creator_id,
            'user_id' => $this->user_id,
            'status' => $this->status,
            'username' => $this->username,
        );
        return $arr;
    }
}
