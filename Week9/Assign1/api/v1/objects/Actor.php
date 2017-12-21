<?php
require_once 'config'.DIRECTORY_SEPARATOR.'Database.php';

class Actor {

    public $conn;
    public $tableName = "actor";

    public $columns = [
    	"first_name",
    	"last_name"
    ];

    public function connect($db){
        $this->conn = $db;
    }
}