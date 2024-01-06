<?php

require_once $_ENV['PWD'] . '/app/service/BaseService.php';
require_once $_ENV['PWD'] . '/app/models/songsModel.php';
require_once $_ENV['PWD'] . '/app/crud-db/crudSongs.php';

class SongService extends BaseService {
    protected static $instance;

    private function __construct() {
        parent::__construct();
        $this->repo = crudSongs::getInstance();
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new SongService();
        }
        return self::$instance;
    }

    public function getSongs($title, $searchBy, $sortAttribute, $isAsc, $genre, $releaseDate, $pageNumber, $pageLimit) {
        $queryResult = $this->repo->findSong($title, $searchBy, $releaseDate, $sortAttribute, $isAsc, $genre, $pageNumber, $pageLimit);
        $songs = array();
        foreach ($queryResult as $row) {
            array_push($songs, $row);
        }
        return $songs;
    }
    public function getSongsByAlbumID($album_id){
        return $this->repo->getSongsByAlbumID($album_id);
    }
    
    public function countSongs($title, $searchBy, $sortAttribute, $isAsc, $genre, $releaseDate) {
        return $this->repo->countRow($title, $searchBy, $releaseDate, $sortAttribute, $isAsc, $genre);
    }

    public function getArtists() {
        $queryResult = $this->repo->findArtist();
        return $queryResult;
    }
    
    public function getSongByID($song_id){
        return $this->repo->getSongByID($song_id);
    }
    public function insertSong($title, $release_date, $file_path, $cover_art, $album_id, $genre, $artist_id){
        $songModel = new songsModel();
        $songModel->set('title', $title);
        $songModel->set('release_date',$release_date);
        $songModel->set('file_path', $file_path);
        $songModel->set('cover_art',$cover_art);
        $songModel->set('album_id', $album_id);
        $songModel->set('genre', $genre);
        $songModel->set('artist_id', $artist_id);
        $lastInsertID = $this->repo->insertSong($songModel);
        $newSong = new songsModel();
        $newSong = $this->repo->getSongByID($lastInsertID);
        return $newSong;
    }

    public function addListener($song_id){
        $this->repo->addListener($song_id);
    }

    public function deleteSongByID($song_id){
        return $this->repo->deleteSongByID($song_id);
    }

    public function updateSong($song_id, $title, $file_path, $cover_art, $album_id, $genre, $artist_id){
        $this->repo->updateSong($song_id, $title, $file_path, $cover_art, $album_id, $genre, $artist_id);
        $newSong = $this->getSongByID($song_id);
        return $newSong;
    }
}