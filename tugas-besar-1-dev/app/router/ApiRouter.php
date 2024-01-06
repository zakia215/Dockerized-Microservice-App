<?php

require_once $_ENV['PWD'] . '/app/controller/BaseController.php';
require_once $_ENV['PWD'] . '/app/response/Response.php';
require_once $_ENV['PWD'] . '/app/exceptions/BadRequest.php';
require_once $_ENV['PWD'] . '/app/exceptions/MethodNotAllowed.php';

class ApiRouter {
    private $pathAndHandler;

    public function addHandler($path, $handler, $middleware) {
        $this->pathAndHandler[$path] = [$handler, $middleware];
    }

    public function router($path, $method) {
        try {
            $path = explode("?", $path)[0];
            $this->routing($path, $method);
        } catch (BadRequest $e) {
            header("HTTP/1.0 400 Bad Request");
            echo (new Response(false, $e->getMessage(), null, 400))->json();
        } catch (MethodNotAllowed $e) {
            header("HTTP/1.0 405 Method Not Allowed");
            echo (new Response(false, $e->getMessage(), null, 405))->json();
        } catch (Exception $e) {
            header("HTTP/1.0 500 Internal Server Error");
            echo (new Response(false, $e->getMessage(), null, 500))->json();
        }
    }

    private function routing($path, $method) {
        foreach ($this->pathAndHandler as $key => $value) {
            $match = $this->match($path, $key);
            if ($match[0]) {
                $middlewares = $value[1];

                $isPass = true;
                foreach ($middlewares as $middleware) {
                    $isPass = $middleware($path, $method);

                    if ($isPass) {
                        break;
                    }
                }

                if ($isPass) {
                    echo $value[0]->handle($method, $match[1]);
                    exit();
                }
            }
        }

        throw new MethodNotAllowed();
    }

    public function match($path, $key) {
        $path = explode("/", $path);
        $key = explode("/", $key);
        if (count($path) != count($key)) {
            return [false, []];
        }

        $params = [];
        for ($i = 0; $i < count($path); $i++) {
            if ($key[$i] !== "*" && $key[$i] !== $path[$i]) {
                return [false, []];
            } else if ($key[$i] != $path[$i]) {
                $params[] = $path[$i];
            }
        }

        return [true, $params];
    }
}