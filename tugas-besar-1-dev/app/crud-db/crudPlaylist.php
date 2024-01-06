<?php
class crudPlaylist extends crudBase{
    public function __construct(){
        parent::__construct();
        $this->tableName = 'playlist';
    }
    
    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new static();
        }
        return self::$instance;
    }
    public function getPlaylistByID($playlist_id){
        $sql_query = "SELECT * FROM playlist WHERE playlist_id = $playlist_id;";
        return $this->executeQuery($sql_query);
    }
    public function getPlaylistByTitle($title){
        $sql_query = "SELECT * FROM playlist WHERE title= $title;";
        return $this->executeQuery($sql_query);
    }

}




?>
