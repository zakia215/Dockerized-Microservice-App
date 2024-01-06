<?php

require_once $_ENV['PWD'] . '/app/crud-db/crudBase.php';
require_once $_ENV['PWD'] . '/app/models/SubscriptionModel.php';

class crudSubscription extends crudBase {
    protected static $instance;

    public function __construct() {
        parent::__construct();
        $this->tableName = 'subscriptions';
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function insert($creator_id, $user_id, $username) {
        $sql_query = "INSERT INTO subscriptions (creator_id, user_id, username) VALUES(:creator_id, :user_id, :username)";

        $prepared_query = $this->pdo->prepare($sql_query);
        $prepared_query->bindValue(':creator_id', $creator_id);
        $prepared_query->bindValue(':user_id', $user_id);
        $prepared_query->bindValue(':username', $username);

        $prepared_query->execute();

        return array(
            'creator_id' => $creator_id,
            'user_id' => $user_id,
        );
    }

    public function getSubscriptionById($creator_id, $user_id) {
        $sql_query = "SELECT * FROM subscriptions WHERE creator_id = :creator_id AND user_id = :user_id";

        $prepared_query = $this->pdo->prepare($sql_query);
        $prepared_query->bindValue(':creator_id', $creator_id);
        $prepared_query->bindValue(':user_id', $user_id);

        $prepared_query->execute();

        $queryResult = $prepared_query->fetch(PDO::FETCH_ASSOC);

        return $queryResult;
    }
    
    public function getSubscriptionBySubscriberId($user_id) {
        $sql_query = "SELECT creator_id FROM subscriptions WHERE user_id = :user_id AND status = 'accepted'";

        $prepared_query = $this->pdo->prepare($sql_query);
        $prepared_query->bindValue(':user_id', $user_id);

        $prepared_query->execute();

        $queryResult = $prepared_query->fetchAll(PDO::FETCH_ASSOC);

        return $queryResult;
    }

    public function updateSubscription($creator_id, $user_id, $status) {
        $sql_query = "UPDATE subscriptions SET status = :status WHERE creator_id = :creator_id AND user_id = :user_id";

        $prepared_query = $this->pdo->prepare($sql_query);
        $prepared_query->bindValue(':creator_id', $creator_id);
        $prepared_query->bindValue(':user_id', $user_id);
        $prepared_query->bindValue(':status', $status);

        $prepared_query->execute();

        return array(
            'creator_id' => $creator_id,
            'user_id' => $user_id
        );
    }
}