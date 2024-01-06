<?php
require_once $_ENV['PWD'] . '/app/controller/BaseController.php';
require_once $_ENV['PWD'] . '/app/service/AlbumService.php';
class AlbumController extends BaseController{
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

    public function delete($urlParams){
        $album_id = $urlParams[0];
        $res = $this->service->delete($album_id);
        $response = (new Response(true, $res, "successfully deleted", 200))->json();
        return $response;
    }

    
    public function put($urlParams) {
        parse_str(file_get_contents('php://input'), $_PUT);

        $album_id = $urlParams[0];
        if (isset($_PUT['title'])) {
            $title = $_PUT['title'];
        } else {
            $title = '';
        }

        if (isset($_PUT['artist_id'])) {
            $artist_id = $_PUT['artist_id'];
        } else {
            $artist_id = '';
        }

        if (isset($_PUT['cover_art'])) {
            $cover_art = $_PUT['cover_art'];
        } else {
            $cover_art = '';
        }

        if (isset($_PUT['description'])) {
            $description = $_PUT['description'];
        } else {
            $description = '';
        }

        $res = $this->service->updateAlbum($album_id, $title, $artist_id, $cover_art, $description);

        return (new Response(true, "successfully updated", $res, 200))->json();

    }

}


?>