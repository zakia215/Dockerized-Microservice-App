<?php
require_once $_ENV['PWD'] . '/app/service/SongService.php';
class AddSongController extends BaseController{
    protected static $instance;
    public function __construct($service){
        parent::__construct($service);
    }

    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new static(
                SongService::getInstance()
            );
        }
        return self::$instance;
    }

    public function post($urlParams){
        $title = $_POST['title'];
        $release_date = date("Y-m-d H:i:s");
        $file_path = $_POST['file_path'];
        $cover_art = $_POST['cover_art'];
        $album_id = $_POST['album_id'];
        $genre = $_POST['genre'];
        $artist_id = $_POST['artist_id'];
        $res = $this->service->insertSong($title, $release_date, $file_path, $cover_art, $album_id, $genre, $artist_id);
        return (new Response(true, "Song added successfully", $res, 200))->json();
    }

}

?>