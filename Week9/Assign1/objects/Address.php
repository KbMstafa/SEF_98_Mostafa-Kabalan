<?php
require_once '../config/Database.php';

class Address {

    private $conn;
    private $table_name = "address";

    public $address;
    public $address2 = NULL;
    public $district;
    public $city_id;
    public $postal_code = NULL;
    public $phone;
    public $location;

    public function __construct($db){
        $this->conn = $db;
    }
}