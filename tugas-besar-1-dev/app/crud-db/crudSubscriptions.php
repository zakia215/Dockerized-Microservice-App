<?php

require_once $_ENV['PWD'] . '/app/crud-db/crudBase.php';

    class crudSubscriptions extends crudBase{
        protected static $instance;
        public function __construct(){
            parent::__construct();
            $this->tableName = 'subscriptions';
        }
        public static function getInstance(){
            if(!isset(self::$instance)){
                self::$instance = new crudSubscriptions();
            }
            return self::$instance;
        }
        public function getAllSubscriptionByCreatorID($creator_iD){
            $sql_query = "SELECT * FROM subscriptions WHERE creator_id  = :creator_id";
            $prepared_query = $this->pdo->prepare($sql_query);
            $prepared_query->bindValue(":creator_id", $creator_iD);
            $prepared_query->execute();
            return $prepared_query->fetch(PDO::FETCH_ASSOC);
        }
        public function getAllSubscriptionByUserID($user_id){
            $sql_query = "SELECT * FROM subscriptions WHERE user_id = :user_id";
            $prepared_query = $this->pdo->prepare($sql_query);
            $prepared_query->bindValue(":user_id", $user_id);
            $prepared_query->execute();
            return $prepared_query->fetch(PDO::FETCH_ASSOC);
        }
        public function getSubscriptionsByUserIDAndStatus($user_id, $status){
            $sql_query = "SELECT * FROM subscriptions WHERE user_id = :user_id AND status = :status";
            $prepared_query = $this->pdo->prepare($sql_query);
            $prepared_query->bindValue(":user_id", $user_id);
            $prepared_query->bindValue(":status", $status);
            $prepared_query->execute();
            return $prepared_query->fetch(PDO::FETCH_ASSOC);
        }
        
        public function insertSubscription($creator_id, $user_id, $username, $status){
            $sql_query = "INSERT INTO subscriptions (creator_id, user_id, username, status) VALUES(:creator_id, :user_id, :username, :status)";
            $prepared_query = $this->pdo->prepare($sql_query);
            $prepared_query->bindValue(":creator_id", $creator_id);
            $prepared_query->bindValue(":user_id", $user_id);
            $prepared_query->bindValue(":username", $username);
            $prepared_query->bindValue(":status", $status);
            $prepared_query->execute();
            return $this->pdo->lastInsertId();
        }

        public function updateSubscription($creator_id, $user_id, $status){
            $sql_query = "UPDATE subscriptions SET status = :status WHERE creator_id = :creator_id AND user_id = :user_id";
            $prepared_query = $this->pdo->prepare($sql_query);
            $prepared_query->bindValue(":status", $status);
            $prepared_query->bindValue(":creator_id", $creator_id);    
            $prepared_query->bindValue(":user_id", $user_id);
            $prepared_query->execute();
            return $user_id;
        }
        public function checkSubscriptionStatus($creator_id, $user_id){
            $sql_query = "SELECT status FROM subscriptions WHERE creator_id = :creator_id AND user_id = :user_id";
            $prepared_query = $this->pdo->prepare($sql_query);
            $prepared_query->bindValue(":creator_id", $creator_id);
            $prepared_query->bindValue(":user_id", $user_id);
            $prepared_query->execute();
            return $prepared_query->fetch(PDO::FETCH_ASSOC);
        }
    }


?>