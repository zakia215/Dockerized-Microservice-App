<?php
require_once $_ENV['PWD'] . '/app/crud-db/crudBase.php';
require_once $_ENV['PWD'] . '/app/models/artistModel.php';
class crudArtist extends crudBase{
    protected static $instance;
    public function __construct(){
        parent::__construct();
        $this->tableName = 'artist';
    }
    
    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new static();
        }
        return self::$instance;
    }
    public function getArtistById($artist_id){
        $prepared_query = $this->pdo->prepare("SELECT * FROM artist WHERE artist_id = :artist_id");
        $prepared_query->bindValue(':artist_id', $artist_id);
        $prepared_query->execute();
        $queryResult = $prepared_query->fetch(PDO::FETCH_ASSOC);
        return $queryResult;
    }
    public function getArtistNameBySongID($song_id){
        $sql_query = "SELECT name FROM artist NATURAL INNER JOIN song WHERE song_id = :song_id";
        $prepared_query = $this->pdo->prepare($sql_query);
        $prepared_query->bindValue(":song_id", $song_id);
        $prepared_query->execute();
        $queryResult = $prepared_query->fetch(PDO::FETCH_ASSOC);
        return $queryResult;

    }
    public function getArtistNameByAlbumID($album_id){
        $sql_query = "SELECT name FROM artist NATURAL INNER JOIN album WHERE album_id = :album_id";
        $prepared_query = $this->pdo->prepare($sql_query);
        $prepared_query->bindValue(":album_id", $album_id);
        $prepared_query->execute();
        $queryResult = $prepared_query->fetch(PDO::FETCH_ASSOC);
        return $queryResult;

    }
    public function getAllSongsFromArtist($artist_id){
        $sql_query = "SELECT * FROM song WHERE artist_id = $artist_id;";
        return $this->executeQuery($sql_query);
    }
   
    public function insertNewArtist($artist) {
        $sql_query = "INSERT INTO artist (name, profile_picture) VALUES (:name, :profile_picture)";
        $prepared_query = $this->pdo->prepare($sql_query);
        $prepared_query->bindValue(':name', $artist->get('name'));
        $prepared_query->bindValue(':profile_picture', $artist->get('profile_picture'));
        $prepared_query->execute();
        return $this->pdo->lastInsertId();
    }
    public function deleteArtist($artist_id){
        $sql_query = "DELETE FROM artist WHERE artist_id = :artist_id;";
        $prepared_query = $this->pdo->prepare($sql_query);
        $prepared_query->bindValue(':artist_id', $artist_id);
        $prepared_query->execute();
        return $this->getNumOfRows();
    }

    public function updateArtist($artistId, $name, $profile_picture) {
        $sql_query = "UPDATE artist";
        $count = 0;

        if ($name != '') {
            $sql_query .= " SET name = :name";
            $count++;
        }

        if ($profile_picture != "") {
            if ($count > 0){
                $sql_query .= ", ";
            } else {
                $sql_query .= " SET ";
            }
            $sql_query .= "profile_picture = :profile_picture";
            $count++;
        }

        $sql_query .= " WHERE artist_id = :artist_id";
        $prepared_query = $this->pdo->prepare($sql_query);

        if ($name != '') {
            $prepared_query->bindValue(':name', $name);
        }
        if ($profile_picture != '') {
            $prepared_query->bindValue(':profile_picture', $profile_picture);
        }

        $prepared_query->bindValue(':artist_id', $artistId);
        $prepared_query->execute(); 
        return $artistId;
    }

}



?>