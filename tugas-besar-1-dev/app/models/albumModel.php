<?php
require_once $_ENV['PWD'] . '/app/models/baseModel.php';

class albumModel extends baseModel{
    public $album_id;
    public $title;
    public $release_date;
    public $cover_art;
    public $description;
    public $artist_id;

    public function __construct(){
        parent::__construct();
        $this->primaryKey = 'album_id';
    }
    public function populateFromAssosiativeArr($arr){
        $this->album_id = $arr['album_id'];
        $this->title = $arr['title'];
        $this->release_date = $arr['release_date'];
        $this->cover_art = $arr['cover_art'];
        $this->description = $arr['description'];
        $this->artist_id = $arr['artist_id'];
    }
    public function getAssosiativeArray(){
        $arr = array('album_id' => $this->album_id,
        'title' => $this->title,
        'release_date' => $this->release_date,
        'cover_art' => $this->cover_art,
        'description' => $this->description,
        'artist_id' => $this->artist_id
        );
        return $arr;
    }
}



?>