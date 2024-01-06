<?php

require_once $_ENV['PWD'] . '/app/controller/BaseController.php';
require_once $_ENV['PWD'] . '/app/service/SubscriptionService.php';

class SubscribedPodcasterController extends BaseController {
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
        $user_id = $_GET['user-id'];

        $podcasters_response = RestClient::getPodcasters();
        $subscribed_podcasters = SubscriptionService::getInstance()->getSubscribedPodcast($user_id);
        // $pageNumber = $_GET['page'] ?? 1;
        // $pageLimit = $_GET['limit'] ?? 3;

        $podcasters = $podcasters_response->data;
        $num_of_podcasters = count($podcasters);
        // $allPages = ceil($num_of_podcasters / $pageLimit);

        $html = '';
        foreach($podcasters as $podcaster){
            $html .= podcaster_container($podcaster, $subscribed_podcasters);
        }
        // $html .= '<div id = "separator"> </div>';
        // $html .= page_container($pageNumber, $allPages);
        echo $html;
    }
}