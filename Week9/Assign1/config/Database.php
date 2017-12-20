<?php
require_once'config.php';

class Database {

    
    // specify database credentials
    private $host = host;
    private $dbName = dbName;
    private $usrName = usrName;
    private $usrPass = usrPass;
    public $conn;
 
    // get the database connection
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName, $this->usrName, $this->usrPass);
        } catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>