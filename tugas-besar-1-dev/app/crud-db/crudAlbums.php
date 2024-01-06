<?php
require_once $_ENV['PWD'] . '/app/crud-db/crudBase.php';
require_once $_ENV['PWD'] . '/app/models/albumModel.php';
class crudAlbums extends crudBase{
    protected static $instance;
    public function __construct(){
        parent::__construct();
        $this->tableName = 'album';
    }
    
    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new static();
        }
        return self::$instance;
    }
    public function getAlbumByID($album_id){
        $sql_query = "SELECT * FROM album WHERE album_id = :album_id";
        $prepared_query = $this->pdo->prepare($sql_query);
        $prepared_query->bindValue(":album_id", $album_id, PDO::PARAM_INT);
        $prepared_query->execute();
        return $prepared_query->fetch();
    }
    public function getAlbumByArtistID($artist_id){
        $sql_query = "SELECT * FROM album WHERE artist_id = :artist_id";
        $prepared_query = $this->pdo->prepare($sql_query);
        $prepared_query->bindValue(":artist_id", $artist_id);
        $prepared_query->execute();
        return $prepared_query->fetchAll();
    }
    public function getSortedAlbumByName($asc){ // if asc $asc = 1
        if($asc == 1){
            $sql_query = "SELECT * FROM album ORDER BY title;";
        }else{
            $sql_query = "SELECT * FROM album ORDER BY title DESC;";
        }
        return $this->executeQuery($sql_query);
    }
    public function getSortedAlbumByArtist($asc){
        if($asc == 1){
            $sql_query = "SELECT * FROM album NATURAL INNER JOIN artist ORDER BY artist.name;";
        }else{
            $sql_query = "SELECT * FROM album NATURAL INNER JOIN artist ORDER BY artist.name DESC;";
        }
        return $this->executeQuery($sql_query);
    }
    public function getAlbumByArtist($artist_name){
        $sql_query = "SELECT * FROM album NATURAL INNER JOIN artist WHERE artist.name = $artist_name;";
        return $this->executeQuery($sql_query);
    }
    public function insertNewAlbum($album){
        $sql_query = "INSERT INTO album (title, release_date, cover_art, description, artist_id) VALUES (:title, :release_date, :cover_art, :description, :artist_id)";
        $prepared_query = $this->pdo->prepare($sql_query);
        print_r($album);
        $prepared_query->bindValue(':title', $album->get('title'));
        $prepared_query->bindValue(':release_date', $album->get('release_date'));
        $prepared_query->bindValue(':cover_art', $album->get('cover_art'));
        $prepared_query->bindValue(':description', $album->get('description'));
        $prepared_query->bindValue(':artist_id', $album->get('artist_id'));
        $prepared_query->execute();
        return $this->pdo->lastInsertId();

    }
    public function getAllSongsFromAlbum($album_id){
        $sql_query = "SELECT * FROM songs WHERE album_id = $album_id;";
        return $this->executeQuery($sql_query);
    }
    public function deleteAlbum($album_id){
        $sql_query = "DELETE FROM album WHERE album_id = :album_id;";
        $prepared_query = $this->pdo->prepare($sql_query);
        $prepared_query -> bindValue(':album_id', $album_id);
        $prepared_query->execute();
        return $album_id;
    }

    public function updateAlbum($album_id, $title, $artist_id, $cover_art, $description){
        
        $sql_query = "UPDATE album";
        $count = 0;

        if ($title != '') {
            $sql_query .= " SET title = :title";
            $count++;
        }

        if ($artist_id != "") {
            if ($count > 0){
                $sql_query .= ", ";
            } else {
                $sql_query .= " SET ";
            }
            $sql_query .= "artist_id = :artist_id";
            $count++;
        }

        if ($cover_art != "") {
            if ($count > 0){
                $sql_query .= ", ";
            } else {
                $sql_query .= " SET ";
            }
            $sql_query .= "cover_art = :cover_art";
            $count++;
        }

        if ($description != "") {
            if ($count > 0){
                $sql_query .= ", ";
            } else {
                $sql_query .= " SET ";
            }
            $sql_query .= "description = :description";
            $count++;
        }

        $sql_query .= " WHERE album_id = :album_id";
        $prepared_query = $this->pdo->prepare($sql_query);

        if ($title != '') {
            $prepared_query->bindValue(':title', $title);
        }
        if ($artist_id != '') {
            $prepared_query->bindValue(':artist_id', $artist_id);
        }
        if ($cover_art != '') {
            $prepared_query->bindValue(':cover_art', $cover_art);
        }
        if ($description != '') {
            $prepared_query->bindValue(':description', $description);
        }

        $prepared_query->bindValue(':album_id', $album_id);
        $prepared_query->execute();

        return $album_id;
    }


}



?>