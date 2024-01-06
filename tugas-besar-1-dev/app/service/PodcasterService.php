<?php

require_once $_ENV['PWD'] . '/app/service/BaseService.php';
require_once $_ENV['PWD'] . '/app/crud-db/crudPodcaster.php';

class PodcasterService extends BaseService {
    protected static $instance;

    private function __construct() {
        parent::__construct();
        $this->repo = crudPodcaster::getInstance();
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static(null);
        }
        return self::$instance;
    }

    public function addPodcaster($cover_art, $description, $name) {
        $id = $this->repo->insert($cover_art, $description, $name);
        
        $podcaster = $this->repo->getById($id);

        if ($podcaster == null) {
            throw new Exception("internal server error", 500);
        }

        return $podcaster;
    }

}