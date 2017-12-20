<?php
require_once '../config/Database.php';

class Staff {

    private $conn;
    private $table_name = "staff";

    public $first_name;
    public $last_name;
    public $address_id;
    public $picture = NULL;
    public $email = NULL;
    public $store_id;
    public $active;
    public $username;
    public $password = NULL;

    public function __construct($db){
        $this->conn = $db;
    }
}