<?php
require_once 'config'.DIRECTORY_SEPARATOR.'Database.php';

class Store {

    private $conn;
    private $table_name = "store";

    public $manager_staff_id;
    public $address_id;

    public function __construct($db){
        $this->conn = $db;
    }
}