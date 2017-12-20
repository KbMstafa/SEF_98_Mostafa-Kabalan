<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/Database.php';
 
// instantiate film object
include_once '../objects/Film.php';
 
$database = new Database();
$db = $database->getConnection();
 
$film = new Film($db);
 
// create the film
if($film->create()){
    echo '{';
        echo '"message": "Film was created."';
    echo '}';
}
 
// if unable to create the film, tell the user
else{
    echo '{';
        echo '"message": "Unable to create film."';
    echo '}';
}
?>