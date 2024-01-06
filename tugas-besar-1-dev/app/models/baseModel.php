<?php

abstract class baseModel{
    protected $primaryKey;

    public function __construct(){
        
    }
    public function get($key){
        return $this->$key;
    }
    public function set($key, $value){
        $this->$key = $value;
        return $this;
    }
    abstract public function populateFromAssosiativeArr($arr);
    abstract public function getAssosiativeArray();


}


?>