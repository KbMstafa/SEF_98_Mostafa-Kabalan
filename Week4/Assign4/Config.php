<?php
$dbCon = new mysqli('localhost','root','889723417');
$query = "CREATE USER IF NOT EXISTS 'sakilaRental'@'localhost' IDENTIFIED BY 'sakila123';";
$dbCon->query($query);
$query = "GRANT ALL PRIVILEGES ON sakila.* TO 'sakilaRental'@'localhost';";
$dbCon->query($query);
$query = "FLUSH PRIVILEGES;";
$dbCon->query($query);
$dbCon->Close();
$host = "localhost";
$usrName = "sakilaRental";
$usrPass = "sakila123";
$dbName = "sakila";
?>