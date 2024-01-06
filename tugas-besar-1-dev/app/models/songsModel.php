<?php

require_once $_ENV['PWD'] . '/app/models/baseModel.php';

class songsModel extends baseModel{
    public $song_id;
    public $title;
    public $release_date;
    public $file_path;
    public $cover_art;
    public $album_id;
    public $genre;
    public $artist_id;


    public function __construct(){
        parent::__construct();
        $this->primaryKey='song_id';
    }

    public function populateFromAssosiativeArr($model){
        $this->song_id = $model['song_id'];
        $this->title = $model['title'];
        $this->release_date = $model['release_date'];
        $this->file_path = $model['file_path'];
        $this->cover_art = $model['cover_art'];
        $this->album_id = $model['album_id'];
        $this->genre = $model['genre'];
        $this->artist_id = $model['artist_id'];

    }
    public function getAssosiativeArray(){
        $arr = array(
            'song_id' => $this->song_id,
            'title' => $this->title,
            'release_date' => $this->release_date,
            'file_path' => $this->file_path,
            'cover_art' => $this->cover_art,
            'album_id' => $this->album_id,
            'genre' => $this->genre,
            'artist_id' => $this->genre
        );
        return $arr;
    }
}

?>