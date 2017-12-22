<?php
require_once 'config'.DIRECTORY_SEPARATOR.'Database.php';

class Store {

    public $conn;
    public $tableName = "store";

    public $primaryKey = "store_id";
    public $columns = [
    	"manager_staff_id",
    	"address_id"
	];

    public function connect($db){
        $this->conn = $db;
    }
}