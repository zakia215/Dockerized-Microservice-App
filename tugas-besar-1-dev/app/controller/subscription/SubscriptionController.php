<?php

require_once $_ENV['PWD'] . '/app/controller/BaseController.php';
require_once $_ENV['PWD'] . '/app/service/SubscriptionService.php';
require_once $_ENV['PWD'] . '/app/service/UserService.php';
require_once $_ENV['PWD'] . '/app/models/usersModel.php';
require_once $_ENV['PWD'] . '/app/models/SubscriptionModel.php';
require_once $_ENV['PWD'] . '/app/clients/SoapServiceClient.php';

class SubscriptionController extends BaseController {
    protected static $instance;

    public function __construct($service) {
        parent::__construct($service);
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static(
                SubscriptionService::getInstance()
            );
        }
        return self::$instance;
    }

    public function post($urlParams) {
        try {

            if (!isset($_POST['creator_id']) || !isset($_POST['user_id'])) {
                return ((new Response(false, "invalid request body", null, 400))->json());
            }

            $creator_id = $_POST['creator_id'];
            $user_id = $_POST['user_id'];

            $user = UserService::getInstance()->getUserByUserId($user_id);
            if ($user == null) {
                return ((new Response(false, "insert failed", null, 404))->json());
            }

            $username = $user->get('username');

            try {
                $subscription = $this->service->subscribe($creator_id, $user_id, $username);
                if ($subscription == null) {
                    return ((new Response(false, "subscription failed", null, 500))->json());
                }
    
                return (new Response(true, "successfully subscribed", $subscription, 201))->json();

            } catch (Exception $e) {
                if ($e->getCode() == 400) {
                    return ((new Response(false, $e->getMessage(), null, 400))->json());
                } 
                throw $e;
            }

        } catch (Exception $e) {
            return (new Response(false, "internal server error", null, 500))->json();
        }
    }

    public function put($urlParams) {
        try {
            parse_str(file_get_contents('php://input'), $_PUT);

            if (count($urlParams) != 2 || !isset($_PUT["status"])) {
                return ((new Response(false, "Invalid URL Params", null, 400))->json());
            }

            $creator_id = $urlParams[0];
            $user_id = $urlParams[1];
            if (isset($_PUT['status'])) {
                $status = $_PUT['status'];
            } else {
                $status = '';
            }
            
            if ($status != 'accepted' && $status != 'rejected') {
                return ((new Response(false, "Invalid status", null, 400))->json());
            } else if ($status == 'accepted') {
                $res = $this->service->acceptSubscription($creator_id, $user_id);
            } else if ($status == 'rejected') {
                $res = $this->service->rejectSubscription($creator_id, $user_id);
            }
            return (new Response(true, "successfully updated", $res, 200))->json();
        } catch (Exception $e) {
            return (new Response(false, $e->getMessage(), null, 500))->json();
        }

    }
}