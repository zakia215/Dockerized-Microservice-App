<?php

require_once $_ENV['PWD'] . '/app/models/baseModel.php';

class PodcasterModel extends baseModel {
    public $podcaster_id;
    public $cover_art;
    public $description;
    public $name;
    
    public function __construct() {
        parent::__construct();
        $this->primaryKey = 'podcaster_id';
    }

    public function populateFromAssosiativeArr($arr) {
        $this->podcaster_id = $arr['podcaster_id'];
        $this->cover_art = $arr['cover_art'];
        $this->description = $arr['description'];
        $this->name = $arr['name'];
    }

    public function getAssosiativeArray() {
        $arr = array(
            'podcaster_id' => $this->podcaster_id,
            'cover_art' => $this->cover_art,
            'description' => $this->description,
            'name' => $this->name,
        );
        return $arr;
    }
}