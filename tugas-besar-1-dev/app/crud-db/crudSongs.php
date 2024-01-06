<?php
require_once __DIR__ . '/../models/songsModel.php';
require_once $_ENV['PWD'] . '/app/crud-db/crudBase.php';
class crudSongs extends crudBase{
    protected static $instance;

    public function __construct(){
        parent::__construct();
        $this->tableName = 'song';
    }
    
    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new crudSongs();
        }
        return self::$instance;
    }
    public function getSongByID($song_id){
        $sql_query = "SELECT * FROM song WHERE song_id = :songId";
        $prepared_query = $this->pdo->prepare($sql_query);
        $prepared_query->bindValue(':songId', $song_id, PDO::PARAM_INT);
        $prepared_query->execute();
        return $prepared_query->fetch(PDO::FETCH_ASSOC);
    }
    public function getSongByGenre($genre){
        $sql_query = "SELECT * FROM song WHERE genre = $genre;";
        return $this->executeQuery($sql_query);
    }
    public function getSongsByAlbumID($album_id){
        $sql_query = "SELECT * FROM song WHERE album_id = :album_id";
        $prepared_query = $this->pdo->prepare($sql_query);
        $prepared_query->bindValue(':album_id', $album_id);
        $prepared_query->execute();
        return $prepared_query->fetchAll();

    }
    public function getSongByArtist($artist_name){
        $sql_query = "SELECT * FROM song NATURAL INNER JOIN artist WHERE artist.name = $artist_name;";
        return $this->executeQuery($sql_query);
    }

    public function addListener($song_id){
        $sql_query = "UPDATE song SET streams = streams + 1 WHERE song_id = :song_id;";
        $prepared_query = $this->pdo->prepare($sql_query);
        $prepared_query->bindValue(':song_id', $song_id);
        $prepared_query->execute();
    }

    public function getSortedSongByName($asc){
        if($asc == 1){
            $sql_query = "SELECT * FROM song ORDER BY title;";
        }else{
            $sql_query = "SELECT * FROM song ORDER BY title DESC;";
        }
        return $this->executeQuery($sql_query);
    }
    public function getSortedSongByArtist($asc){
        if($asc==1){
            $sql_query = "SELECT * FROM song  NATURAL INNER JOIN artist ORDER BY artist.name;";
        }else{
            $sql_query = "SELECT * from song  NATURAL INNER JOIN artist ORDER BY artist.name DESC;";
        }
        return $this->executeQuery($sql_query);

    }
    public function insertSong($model){
        $sql_query = "INSERT INTO song (title, release_date, file_path, cover_art, album_id, genre, artist_id) VALUES
        (:title, :release_date, :file_path, :cover_art, :album_id, :genre, :artist_id)";
        $prepared_query = $this->pdo->prepare($sql_query);
        $prepared_query->bindValue(":title", $model->get('title'));
        $prepared_query->bindValue(":release_date", $model->get('release_date'));
        $prepared_query->bindValue(":file_path", $model->get('file_path'));
        $prepared_query->bindValue(":cover_art", $model->get('cover_art'));
        $prepared_query->bindValue(":album_id", $model->get('album_id'));
        $prepared_query->bindValue(":genre", $model->get('genre'));
        $prepared_query->bindValue(":artist_id", $model->get('artist_id'));
        $prepared_query->execute();
        return $this->pdo->lastInsertId();

    }
    public function findSong($title, $searchBy, $releaseDate, $sortAttribute, $isAsc, $genre, $pageNumber, $pageLimit) {
        $sql_query = "SELECT * FROM song NATURAL INNER JOIN artist";
        $count = 0;
        if ($title != "") {
            $sql_query .= " WHERE ";
            if ($searchBy == "artist") {
                $sql_query .= "LOWER(artist.name) LIKE LOWER(:title)";
            } else if ($searchBy == "title") {
                $sql_query .= "LOWER(title) LIKE LOWER(:title)";
            }
            $count++;
        }

        if ($releaseDate != "") {
            if ($count > 0){
                $sql_query .= " AND ";
            } else {
                $sql_query .= " WHERE ";
            }
            $sql_query .= "(EXTRACT(YEAR FROM current_timestamp) - EXTRACT(YEAR FROM release_date)) * 12 + (EXTRACT(MONTH FROM current_timestamp) - EXTRACT(MONTH FROM release_date)) < $releaseDate";
            $count++;
        }

        if ($genre != "") {
            if($count > 0){
                $sql_query .= " AND ";
            } else {
                $sql_query .= " WHERE ";
            }
            $sql_query .= "genre = :genre";
            $count++;
        }
        if($sortAttribute !== ""){
            if ($sortAttribute == "title") {
                $sql_query .= " ORDER BY title";
            } else if($sortAttribute == "artist") {
                $sql_query .= " ORDER BY artist.name";
            }
            if ($isAsc == 'true') {
                $sql_query .= " ASC";
            } else {
                $sql_query .= " DESC";
            }
        }
        $offset = ($pageNumber - 1) * $pageLimit;
        $sql_query .= " LIMIT :pageLimit OFFSET :offset;";

        $prepared_query = $this->pdo->prepare($sql_query);
        if ($title != "") {
            $sub_title = "%$title%";
            $prepared_query->bindValue(':title', $sub_title, PDO::PARAM_STR);
        }
        if ($genre != "") {
            $prepared_query->bindValue(':genre', $genre, PDO::PARAM_STR);
        }
        $prepared_query->bindValue(':pageLimit', $pageLimit, PDO::PARAM_INT);
        $prepared_query->bindValue(':offset', $offset, PDO::PARAM_INT);

        $prepared_query->execute();

        return $prepared_query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countRow($title, $searchBy, $releaseDate, $sortAttribute, $isAsc, $genre) {
        $sql_query = "SELECT * FROM song NATURAL INNER JOIN artist";
        $count = 0;
        if ($title != "") {
            $sql_query .= " WHERE ";
            $sql_query .= "LOWER(title) LIKE LOWER(:title)";
            $count++;
        }

        if ($releaseDate !== "") {
            if ($count > 0){
                $sql_query .= " AND ";
            } else {
                $sql_query .= " WHERE ";
            }
            $sql_query .= "(EXTRACT(YEAR FROM current_timestamp) - EXTRACT(YEAR FROM release_date)) * 12 + (EXTRACT(MONTH FROM current_timestamp) - EXTRACT(MONTH FROM release_date)) < $releaseDate";
            $count++;
        }

        if ($genre != "") {
            if($count > 0){
                $sql_query .= " AND ";
            } else {
                $sql_query .= " WHERE ";
            }
            $sql_query .= "genre = :genre";
            $count++;
        }
        if($sortAttribute !== ""){
            if ($sortAttribute == "title") {
                $sql_query .= " ORDER BY title";
            } else if($sortAttribute == "artist") {
                $sql_query .= " ORDER BY artist.name";
            }
            if ($isAsc == 'true') {
                $sql_query .= " ASC";
            } else {
                $sql_query .= " DESC";
            }
        }

        $prepared_query = $this->pdo->prepare($sql_query);
        if ($title != "") {
            $sub_title = "$title%";
            $prepared_query->bindValue(':title', $sub_title, PDO::PARAM_STR);
        }
        if ($genre != "") {
            $prepared_query->bindValue(':genre', $genre, PDO::PARAM_STR);
        }

        $prepared_query->execute();

        $queryResult = $prepared_query->fetchAll(PDO::FETCH_ASSOC);
        return count($queryResult);
    }

    public function deleteSongByID($song_id){
        $sql_query = "DELETE FROM song WHERE song_id = :song_id;";
        $prepared_query = $this->pdo->prepare($sql_query);
        $prepared_query->bindValue(':song_id', $song_id);
        $prepared_query->execute();
        return $this->getNumOfRows();
    }

    public function editSong($model){
        $model_arr = $model->getAssosiativeArray();
        $sql_query = "UPDATE song SET ";
        $count = 0;
        foreach($model as $key => $value){
            $count++;
            $sql_query .= "$key = $value" ;
            if($count < count($model)){
                $sql_query .= ",";
            }
        }
        $sql_query .= "WHERE song_id = $model->get('song_id')";
        
    }

    public function findArtist(){
            $sql_query = "SELECT artist_id, name as artist_name FROM artist;";
            $prepared_query = $this->pdo->prepare($sql_query);
            $prepared_query->execute();
            return $prepared_query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateSong($song_id, $title, $file_path, $cover_art, $album_id, $genre, $artist_id){
        
        $sql_query = "UPDATE song";
        $count = 0;

        if ($title != '') {
            $sql_query .= " SET title = :title";
            $count++;
        }

        if ($file_path != "") {
            if ($count > 0){
                $sql_query .= ", ";
            } else {
                $sql_query .= " SET ";
            }
            $sql_query .= "file_path = :file_path";
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

        if ($album_id != "") {
            if ($count > 0){
                $sql_query .= ", ";
            } else {
                $sql_query .= " SET ";
            }
            $sql_query .= "album_id = :album_id";
            $count++;
        }

        if ($genre != "") {
            if ($count > 0){
                $sql_query .= ", ";
            } else {
                $sql_query .= " SET ";
            }
            $sql_query .= "genre = :genre";
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

        $sql_query .= " WHERE song_id = :song_id";

        $prepared_query = $this->pdo->prepare($sql_query);

        if ($title != '') {
            $prepared_query->bindValue(':title', $title);
        }
        if ($file_path != '') {
            $prepared_query->bindValue(':file_path', $file_path);
        }
        if ($cover_art != '') {
            $prepared_query->bindValue(':cover_art', $cover_art);
        }
        if ($album_id != '') {
            $prepared_query->bindValue(':album_id', $album_id);
        }
        if ($genre != '') {
            $prepared_query->bindValue(':genre', $genre);
        }
        if ($artist_id != '') {
            $prepared_query->bindValue(':artist_id', $artist_id);
        }

        $prepared_query->bindValue(':song_id', $song_id);
        $prepared_query->execute();
        return $song_id;
    }
}



?>