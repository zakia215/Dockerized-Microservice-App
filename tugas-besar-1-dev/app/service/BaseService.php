<?php

abstract class BaseService {
    protected static $instance;
    protected $repo;
    
    protected function __construct() {
    }
 
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static(null);
        }
        return self::$instance;
    }
    public function getSomeOfRowsByLimit($firstRecord, $numOfRecordPerPage){
        return $this->repo->getSomeOfRowsByLimit($firstRecord, $numOfRecordPerPage);
    }
    public function get7Rows(){
        return $this->repo->get7Rows();
    }

}