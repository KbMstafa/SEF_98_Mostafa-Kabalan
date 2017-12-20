<?php
require_once '../config/Database.php';

class Customer {

    private $conn;
    private $table_name = "customer";

    public $store_id;
    public $first_name;
    public $last_name;
    public $email = NULL;
    public $address_id;
    public $active;

    public function __construct($db){
        $this->conn = $db;
    }
}