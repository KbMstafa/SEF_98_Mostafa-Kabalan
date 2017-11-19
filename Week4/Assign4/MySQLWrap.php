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
    function selectFilms($query) {
        $result = $this->dbCon->prepare($query);
        $result->execute();
        $result-> bind_result($id, $title, $duration, $amount);
        while ($result->fetch()) {
            yield array($id, "$title &emsp; \"$amount for $duration days\"");
        }
    }
    function selectCustomers($query) {
        $result = $this->dbCon->prepare($query);
        $result->execute();
        $result-> bind_result($id, $firstname, $lastname);
        while ($result->fetch()) {
            yield array($id, "$firstname $lastname");
        }
    }

    function selectInventory($query) {
        $result = $this->dbCon->prepare($query);
        $result->bind_param("i", $_POST["films"]);
        $result->execute();
        $result-> bind_result($invId, $staffId);
        $result->fetch();
        return array($invId, $staffId);
    }
}
?>