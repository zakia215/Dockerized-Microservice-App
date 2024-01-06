<?php

class MethodNotAllowed extends Exception {
    public function __construct($message = "Method Not Allowed", $code = 405, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}