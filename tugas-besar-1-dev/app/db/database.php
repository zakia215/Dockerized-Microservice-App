<?php

class Database {
    private static $instance;
    private $pdo;

    private function __construct() {
        $db_config = parse_ini_file('db.ini');
        if ($db_config === false) {
            throw new \Exception('Error in reading db config');
        }

        $connection = sprintf(
            "pgsql:host=%s;port=%d;dbname=%s;user=%s;password=%s",
            $db_config['host'],
            $db_config['port'],
            'postgres',
            $db_config['username'],
            $db_config['password']
        );

        try {
            $this->pdo = new \PDO($connection);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            throw new \Exception('PDO connection failed: ' . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->pdo;
    }

    public function __toString() {
        return 'Database connection instance';
    }
}

$db = Database::getInstance();
$connection = $db->getConnection();

// echo $db; // This will now display "Database connection instance"
