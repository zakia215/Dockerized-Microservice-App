<?php
require_once $_ENV['PWD'] . '/app/controller/BaseController.php';
require_once $_ENV['PWD'] . '/app/service/AlbumService.php';
class AddAlbumController extends BaseController{
    protected static $instance;

    public function __construct($service) {
        parent::__construct($service);
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static(
                AlbumService::getInstance()
            );
        }
        return self::$instance;
    }
    public function post($urlParams){
        $title = $_POST['title'];
        $release_date = date("Y-m-d H:i:s");
        $cover_art = $_POST['cover_art'];
        $description = $_POST['description'];
        $artist_id = $_POST['artist_id'];
        $album = $this->service->addAlbum($title, $release_date,$cover_art, $description, $artist_id);
        return (new Response(true, "Artist created successfully", $album->getAssosiativeArray(), 200))->json();

    }
    
}


?>