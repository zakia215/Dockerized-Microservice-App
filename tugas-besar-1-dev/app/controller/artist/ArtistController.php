<?php

require_once $_ENV['PWD'] . '/app/controller/BaseController.php';
require_once $_ENV['PWD'] . '/app/service/ArtistService.php';

class ArtistController extends BaseController {
    protected static $instance;

    public function __construct($service) {
        parent::__construct($service);
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static(
                ArtistService::getInstance()
            );
        }
        return self::$instance;
    }

    public function delete($urlParams){
        $artist_id = $urlParams[0];
        $res = $this->service->deleteArtist($artist_id);
        $response = (new Response(true, $res, "successfully deleted", 200))->json();
        return $response;
    }

    public function put($urlParams) {
        $artist_id = $urlParams[0];

        parse_str(file_get_contents('php://input'), $_PUT);

        if (isset($_PUT['name'])) {
            $name = $_PUT['name'];
        } else {
            $name = '';
        }

        if (isset($_PUT['profile-picture'])) {
            $profile_picture = $_PUT['profile-picture'];
        } else {
            $profile_picture = '';
        }

        $res = $this->service->updateArtist($artist_id, $name, $profile_picture);
        return (new Response(true, "successfully updated", $res, 200))->json();
    }

}
