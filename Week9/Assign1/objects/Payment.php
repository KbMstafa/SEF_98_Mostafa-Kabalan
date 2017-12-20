<?php
require_once '../config/Database.php';

class Payment {

    private $conn;
    private $table_name = "payment";

    public $customer_id;
    public $staff_id;
    public $rental_id = NULL;
    public $amoun;

    public function __construct($db){
        $this->conn = $db;
    }
}