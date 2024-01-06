<?php

class DatabaseException extends Exception {
    public function __construct($message = "Something wrong in the database", $code = 500, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}