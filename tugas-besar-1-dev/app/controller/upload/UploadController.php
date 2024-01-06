<?php

require_once $_ENV['PWD'] . '/app/controller/BaseController.php';
require_once $_ENV['PWD'] . '/app/service/UploadService.php';
require_once $_ENV['PWD'] . '/app/response/Response.php';

class UploadController extends BaseController {
    protected static $instance;

    private function __construct($service) {
        parent::__construct($service);
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static(
                UploadService::getInstance()
            );
        }
        return self::$instance;
    }

    public function post($urlParams) {

        json_encode($_FILES);

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

        $path = $this->service->uploadFile($_FILES['file']);
        $isSuccess = $path !== false;

        if (!$isSuccess || !file_exists($path)) {
            throw new BadRequest("Failed to upload file");
        }

        return (new Response(true, "File uploaded successfully", $path, 200))->json();
    }
}