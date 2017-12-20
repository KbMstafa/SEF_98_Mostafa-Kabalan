<?php
require_once '../config/Database.php';

class Actor {

    private $conn;
    private $table_name = "actor";

    public $first_name;
    public $last_name;

    public function __construct($db){
        $this->conn = $db;
    }
}