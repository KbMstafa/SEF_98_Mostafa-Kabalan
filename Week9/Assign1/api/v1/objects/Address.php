<?php
require_once 'config'.DIRECTORY_SEPARATOR.'Database.php';

class Address {

    public $conn;
    public $tableName = "address";

    public $columns = [
        "address",
        "address2",          //NULL
        "district",
        "city_id",
        "postal_code",       //NULL
        "phone",
        "location"
    ];
    
    public function connect($db){
        $this->conn = $db;
    }
}