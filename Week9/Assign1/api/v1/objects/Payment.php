<?php
require_once 'config'.DIRECTORY_SEPARATOR.'Database.php';

class Payment {

    public $conn;
    public $tableName = "payment";

    public $primaryKey = "payment_id";
    public $columns = [
        "customer_id",
    	"staff_id",
    	"rental_id",      //NULL
    	"amount"
    ];

    public function connect($db){
        $this->conn = $db;
    }
}