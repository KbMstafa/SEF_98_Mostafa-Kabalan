<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once '../config/Database.php';
require_once '../objects/Film.php';

$database = new Database();
$db = $database->getConnection();

$film = new Film($db);

$stmt = $film->read();
$num = $stmt->rowCount();

if($num > 0){

    $products_arr=array();
    $products_arr["records"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        array_push($products_arr["records"], $row);
    }
 
    echo json_encode(
        $products_arr, 
        JSON_PRETTY_PRINT
    );
} else {
    echo json_encode(
        array("message" => "No products found."), 
        JSON_PRETTY_PRINT
    );
}
?>