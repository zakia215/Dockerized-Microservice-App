<?php

require_once $_ENV['PWD'] . '/app/crud-db/crudBase.php';
require_once $_ENV['PWD'] . '/app/models/PodcasterModel.php';

class crudPodcaster extends crudBase {
    protected static $instance;

    public function __construct() {
        parent::__construct();
        $this->tableName = 'podcaster';
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function getById($podcaster_id) {
        $sql_query = "SELECT * FROM podcaster WHERE podcaster_id = :podcaster_id";

        $prepared_query = $this->pdo->prepare($sql_query);
        $prepared_query->bindValue(':podcaster_id', $podcaster_id);

        $prepared_query->execute();

        $query_result = $prepared_query->fetch(PDO::FETCH_ASSOC);

        return $query_result;
    }

    public function insert($cover_art, $description, $name) {
        $sql_query = "INSERT INTO podcaster (cover_art, description, name) VALUES (:cover_art, :description, :name)";

        $prepared_query = $this->pdo->prepare($sql_query);
        $prepared_query->bindValue(':cover_art', $cover_art);
        $prepared_query->bindValue(':description', $description);
        $prepared_query->bindValue(':name', $name);

        $prepared_query->execute();

        return $this->pdo->lastInsertId();
    }
}