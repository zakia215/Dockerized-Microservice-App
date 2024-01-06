<?php

require_once $_ENV['PWD'] . '/app/controller/BaseController.php';
require_once $_ENV['PWD'] . '/app/service/ArtistService.php';

class AddArtistController extends BaseController {
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

    public function post($urlParams) {
        // TODO: Sanitize input
        $artistName = $_POST['artistName'];
        $imgFile = $_POST['imgFile'];
        $artist = $this->service->addArtist($artistName, $imgFile);

        return (new Response(true, "Artist created successfully", $artist->getAssosiativeArray(), 200))->json();
    }

    
}
