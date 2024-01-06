<?php

require_once $_ENV['PWD'] . '/app/service/BaseService.php';

define ('UPLOAD_DIR', $_ENV['PWD'] . '/upload/');

class UploadService extends BaseService {
    protected static $instance;

    private function __construct() {
        parent::__construct();
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static(null);
        }
        return self::$instance;
    }

    public function uploadFile($file) {
        $filename = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileError = $file['error'];

        $fileExt = explode('.', $filename);
        $fileActualExt = strtolower(end($fileExt));

        if ($fileError !== 0) {
            return false;
        }

        // TODO: Check file size

        $dateTime = date("Y-m-d H:i:s");

        $fileNameNew = uniqid($dateTime, true) . "." . $fileActualExt;
        $fileDestination = UPLOAD_DIR . $fileNameNew;

        if (!move_uploaded_file($fileTmpName, $fileDestination)) {
            return false;
        } else {
            return $fileDestination;
        }

    }
}