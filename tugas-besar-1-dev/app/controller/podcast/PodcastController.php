<?php
require_once $_ENV['PWD'] . '/app/controller/BaseController.php';
require_once $_ENV['PWD'] . '/app/clients/RestClient.php';
require_once $_ENV['PWD'] . '/app/view/browse/lib.php';

class PodcastController extends BaseController{
    protected static $instance;

    public function __construct($service) {
        parent::__construct($service);
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static(
                null
            );
        }
        return self::$instance;
    }
    public function get($urlParams){
        $podcaster_id = $_GET['podcaster_id'];
        $podcasts_response = RestClient::getPodcastByPodcasterID($podcaster_id);

        $podcasts = $podcasts_response->data->produced_podcasts;
        // $num_of_podcasters = count($podcasters);

        $html = '';
        foreach($podcasts as $podcast){
            $html .= podcast_container($podcast);
        }
        // $produced_podcasts = $podcasts->produced_podcasts;
        // foreach ($produced_podcasts as $podcast) {
        //     print_r( "Podcast Title: " . $podcast->title );
        //     // You can also access other properties of each podcast object here
        // }

        // print_r($podcasts);
        echo $html;
    }
}