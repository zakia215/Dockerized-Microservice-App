<?php
require_once $_ENV['PWD'] . '/app/service/SongService.php';
class UpdateDeleteSongController extends BaseController{
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

    public function delete($urlParams){
        $song_id = $urlParams[0];
        $res = $this->service->deleteSongByID($song_id);
        $response = (new Response(true, $res, "successfully deleted", 200))->json();
        return $response;
    }

}

?>