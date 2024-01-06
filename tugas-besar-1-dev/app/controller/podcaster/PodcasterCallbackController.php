<?php

require_once $_ENV['PWD'] . '/app/controller/BaseController.php';
require_once $_ENV['PWD'] . '/app/service/PodcasterService.php';

class PodcasterCallbackController extends BaseController {
    protected static $instance;

    public function __construct($service) {
        parent::__construct($service);
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static(
                PodcasterService::getInstance()
            );
        }
        return self::$instance;
    }

    public function post($urlParams) {
        try {
            if (!isset($_POST['cover_art']) || !isset($_POST['name']) || !isset($_POST['description'])) {
                return ((new Response(false, "invalid request body", null, 400))->json());
            }

            $name = $_POST['name'];
            $cover_art = $_POST['cover_art'];
            $description = $_POST['description'];

            $podcaster_arr = $this->service->addPodcaster($cover_art, $description, $name);

            return (new Response(true, "successfully added new podcaster", $podcaster_arr, 201))->json();
        } catch (Exception $e) {
            return (new Response(false, "internal server error", null, 500))->json();
        }
    }
}