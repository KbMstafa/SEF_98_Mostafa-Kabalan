<?php
require_once 'config'.DIRECTORY_SEPARATOR.'Database.php';

class Rental {

    private $conn;
    private $table_name = "rental";

    public $rental_date;
    public $inventory_id;
    public $customer_id;
    public $return_date = NULL;
    public $staff_id;

    public function __construct($db){
        $this->conn = $db;
    }
}