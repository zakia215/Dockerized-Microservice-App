<?php

require_once $_ENV['PWD'] . '/app/db/database.php';

class crudBase{
    protected static $instance;
    protected $tableName;
    protected $primaryKeys;
    protected $pdo;
    
    public function __construct(){
        $this->pdo = Database::getInstance()->getConnection();
    }
    public static function getInstance(){ 
        if(!isset(self::$instance)){
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function getConnection(){
        return $this->pdo;
    }
    public function executeQuery($sql_query){
        $prepared_query = $this->pdo->prepare($sql_query);
        $prepared_query->execute();
        $records = $prepared_query->fetchAll(PDO::FETCH_ASSOC);     // return associative arr
        return $records;
    }
    public function getAllRecord(){
        $sql_query = "SELECT * FROM $this->tableName;";
        return crudBase::executeQuery($sql_query);
    }
    public function getNumOfRows(){
        $sql_query = "SELECT COUNT(*) FROM $this->tableName;";
        return crudBase::executeQuery($sql_query);
    }
    public function getSomeOfRowsByLimit($firstRecord, $numOfRecordPerPage){
        $sql_query = "SELECT * FROM $this->tableName OFFSET $firstRecord LIMIT $numOfRecordPerPage";
        return crudBase::executeQuery($sql_query);
    }
    public function get7Rows(){
        $sql_query = "SELECT * FROM $this->tableName LIMIT 7";
        return crudBase::executeQuery($sql_query);
    }

    
    
}

?>