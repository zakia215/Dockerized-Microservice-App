<?php

class Response {
    public $success;
    public $message;
    public $data;
    public $statusCode;

    public function __construct($success, $message, $data, $statusCode) {
        $this->success = $success;
        $this->message = $message;
        $this->data = $data;
        $this->statusCode = $statusCode;
    }

    public function json() {
        return json_encode($this);
    }
}