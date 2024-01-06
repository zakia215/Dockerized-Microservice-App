<?php
require_once $_ENV['PWD'] . '/app/crud-db/crudArtist.php';
require_once $_ENV['PWD'] . '/app/models/artistModel.php';
require_once $_ENV['PWD'] . '/app/service/BaseService.php';
class ArtistService extends BaseService{
    protected static $instance;

    private function __construct(){
        parent::__construct();
        $this->repo = crudArtist::getInstance();
    }

    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new static(); 
        }
        return self::$instance;
    }
    public function addArtist($name, $profile_picture){
        $artistModel = new artistModel();
        $artistModel->set('name', $name);
        $artistModel->set('profile_picture', $profile_picture);
        $lastInsertID = $this->repo->insertNewArtist($artistModel);
        $newArtist = new artistModel();
        $queryResult = $this->repo->getArtistById($lastInsertID);
        $newArtist->populateFromAssosiativeArr($queryResult);
        return $newArtist;
    }
    public function getArtistByID($artist_id){
        return $this->repo->getArtistByID($artist_id);
    }
    public function getAllArtists(){
        return $this->repo->getAllRecord();
    }
    public function getArtistNameBySongID($song_id){
        return $this->repo->getArtistNameBySongID($song_id);
    }
    public function getArtistNameByAlbumID($album_id){
        return $this->repo->getArtistNameByAlbumID($album_id);
    }
    public function getAllArtistSongs($artist_id){
        return $this->repo->getAllSongsFromArtist($artist_id);
    }
    public function deleteArtist($artist_id){
        return $this->repo->deleteArtist($artist_id);
    }
    public function updateArtist($artist_id, $name, $profile_picture){
        $this->repo->updateArtist($artist_id, $name, $profile_picture);
        $newArtist = $this->getArtistByID($artist_id);
        return $newArtist;
    }
    public function getNumOfRows(){
        return $this->repo->getNumOfRows();
    }
}


?>