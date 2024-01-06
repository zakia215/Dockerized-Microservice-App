<?php
require_once $_ENV['PWD'] . '/app/crud-db/crudAlbums.php';
require_once $_ENV['PWD'] . '/app/models/albumModel.php';
require_once $_ENV['PWD'] . '/app/service/BaseService.php';

class AlbumService extends BaseService{
    
    protected static $instance;
    private function __construct(){
        parent::__construct();
        $this->repo = crudAlbums::getInstance();
    }

    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new static(); 
        }
        return self::$instance;
    }


    public function addAlbum($title, $release_date, $cover_art, $description, $artist_id){
        $albumModel = new albumModel();
        $albumModel->set('title', $title);
        $albumModel->set('release_date', $release_date);
        $albumModel->set('cover_art', $cover_art);
        $albumModel->set('description', $description);
        $albumModel->set('artist_id', $artist_id);
        $lastInsertID = $this->repo->insertNewAlbum($albumModel);
        $newAlbum = new albumModel();
        $queryResult = $this->repo->getAlbumByID($lastInsertID);
        $newAlbum->populateFromAssosiativeArr($queryResult);
        return $newAlbum;
    }
    public function getAlbumByID($album_id){
        return $this->repo->getAlbumByID($album_id);
    }
    public function getAlbumByArtistID($artist_id){
        return $this->repo->getAlbumByArtistID($artist_id);
    }
    public function getAllAlbums(){
        return $this->repo->getAllRecord();
    }
    public function getAllSongsFromAlbum($album_id){
        return $this->repo->getAllSongsFromAlbum($album_id);
    }
    public function deleteAlbum($album_id){
        return $this->repo->deleteAlbum($album_id);
    }
    public function getNumOfRows(){
        return $this->repo->getNumOfRows();
    }
    public function delete($album_id){
        return $this->repo->deleteAlbum($album_id);
    }

    public function updateAlbum($album_id, $title, $artist_id, $cover_art, $description){
        return $this->repo->updateAlbum($album_id, $title, $artist_id, $cover_art, $description);
    }


}


?>