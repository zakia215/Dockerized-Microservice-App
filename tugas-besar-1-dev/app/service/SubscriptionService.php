<?php

require_once $_ENV['PWD'] . '/app/service/BaseService.php';
require_once $_ENV['PWD'] . '/app/crud-db/crudSubscription.php';
require_once $_ENV['PWD'] . '/app/models/SubscriptionModel.php';

class SubscriptionService extends BaseService {
    protected static $instance;

    public function __construct() {
        parent::__construct();
        $this->repo = crudSubscription::getInstance();
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new SubscriptionService();
        }
        return self::$instance;
    }

    public function getSubscribedPodcast($user_id) {
        $subscription_arr = $this->repo->getSubscriptionBySubscriberid($user_id);
        
        return $subscription_arr;
    }

    public function subscribe($creator_id, $user_id, $username) {

        $subscriptionArr = $this->repo->getSubscriptionById($creator_id, $user_id);

        if ($subscriptionArr != null) {
            throw new Exception("Subscription already exists", 400);
        }

        $insertedId = $this->repo->insert($creator_id, $user_id, $username);
        
        if ($insertedId == null) {
            return null;
        }

        $subscriptionArr = $this->repo->getSubscriptionById($creator_id, $user_id);
        $subscription = new SubscriptionModel();
        $subscription->populateFromAssosiativeArr($subscriptionArr);

        return $subscription;
    }

    public function acceptSubscription($creator_id, $user_id){
        $result_arr = $this->repo->updateSubscription($creator_id, $user_id, 'accepted');
        $creator_id = $result_arr['creator_id'];
        $user_id = $result_arr['user_id'];

        $updated_subscription = $this->repo->getSubscriptionById($creator_id, $user_id);
        return $updated_subscription;
    }

    public function rejectSubscription($creator_id, $user_id){
        $result_arr = $this->repo->updateSubscription($creator_id, $user_id, 'rejected');
        $creator_id = $result_arr['creator_id'];
        $user_id = $result_arr['user_id'];

        $updated_subscription = $this->repo->getSubscriptionById($creator_id, $user_id);
        return $updated_subscription;
    }
}