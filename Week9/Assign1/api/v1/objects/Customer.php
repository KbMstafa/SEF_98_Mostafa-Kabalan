<?php
require_once 'config'.DIRECTORY_SEPARATOR.'Database.php';

class Customer {

    public $conn;
    public $tableName = "customer";

    public $primaryKey = "customer_id";
    public $columns = [
        "store_id",
        "first_name",
        "last_name",
        "email",            //NULL
        "address_id",
        "active",
        "create_date"
    ];

    public function connect($db){
        $this->conn = $db;
    }
}
