<?php

class MySQLWrap {
    private $dbCon;

    function __construct() {
        require_once "Config.php";
        $this->dbCon = new mysqli($host, $usrName, $usrPass, $dbName);
        if($dbCon->connect_error) {
            die($dbCon->connect_error);
        }
        else {
            echo "<H1>Welcome to sakila : \n</H1>";
        }
    }

}
?>