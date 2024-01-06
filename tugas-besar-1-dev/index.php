<?php

require_once $_ENV['PWD'] . "/app/router/PageRouter.php";
require_once $_ENV['PWD'] . "/routes.php";
require_once $_ENV['PWD'] . "/app/init/bootstrap.php";

$router = new PageRouter($routes);
$router->route($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
