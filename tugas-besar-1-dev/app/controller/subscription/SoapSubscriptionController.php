<?php

require_once $_ENV['PWD'] . '/app/controller/BaseController.php';
require_once $_ENV['PWD'] . '/app/clients/SoapServiceClient.php';
require_once $_ENV['PWD'] . '/app/models/usersModel.php';

class SoapSubscriptionController extends BaseController {
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

    public function get($urlParams) {
        try {
            $user_id = $_GET['user-id'];
    
            $subscribed_podcaster = $this->service->getSubscribedPodcast($user_id);

            return ((new Response(true, "successfully retrieved all subscribed podcasters", $subscribed_podcaster, 200))->json());
        } catch (Exception $e) {
            return ((new Response(false, $e->getMessage(), null, 500))->json());
        }
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
                return ((new Response(false, "user not found", null, 404))->json());
            }

            $username = $user->get('username');

            $params = array(
                'creator_id' => $creator_id,
                'user_id' => $user_id,
                'username' => $username
            );

            $soap_response = SoapServiceClient::getInstance()->call("subscribe", $params);

            if (isset($soap_response->return)) {
                return (new Response(true, "successfully subscribed", $soap_response->return, 201))->json();
            } else {
                return (new Response(true, "subscription failed", null, 500))->json();
            }
        } catch (Exception $e) {
            return ((new Response(false, $e->getMessage(), null, 500))->json());
        }
    }
}