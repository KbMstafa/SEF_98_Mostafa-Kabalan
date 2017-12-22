<?php
require_once 'config'.DIRECTORY_SEPARATOR.'Database.php';

class Staff {

    public $conn;
    public $tableName = "staff";

    public $primaryKey = "staff_id";
    public $columns = [
        "first_name",
        "last_name",
        "address_id",
        "picture",            //NULL
        "email",              //NULL
        "store_id",
        "active",
        "username",
        "password"            //NULL
    ];

    public function connect($db){
        $this->conn = $db;
    }
}