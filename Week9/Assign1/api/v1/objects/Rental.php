<?php
require_once 'config'.DIRECTORY_SEPARATOR.'Database.php';

class Rental {

    public $conn;
    public $tableName = "rental";

    public $primaryKey = "rental_id";
    public $columns = [
        "rental_date",
        "inventory_id",
        "customer_id",
        "return_date",      //NULL
        "staff_id"
    ];

    public function connect($db){
        $this->conn = $db;
    }
}