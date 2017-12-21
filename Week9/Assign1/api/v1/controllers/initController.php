<?php
foreach (scandir(dirname(__DIR__).DIRECTORY_SEPARATOR.'objects') as $filename) {
    $path = dirname(__DIR__).DIRECTORY_SEPARATOR.'objects'.DIRECTORY_SEPARATOR.$filename;
    if (is_file($path)) {
        require_once $path;
    }
}

class initController {

    public function create($modal) {

        $database = new Database;
        $db = $database->getConnection() ;

        foreach ($_POST as $column => $value) {
            if(in_array($column, $modal->columns)) {
                $columnsValue[$column] = $value;
            }
        }
        
        $modal->connect($db);
    
        $query = "INSERT INTO "
                  . $modal->tableName .
                " SET";

        foreach ($columnsValue as $column => $value) {
            if($column == "location") {
                $query .= " $column = POINT(:x, :y)";
            } else {
                $query .= " $column = :$column";
            }
            if($value != end($columnsValue)) {
                $query .= ",";
            }
        }
    
        $stmt = $modal->conn->prepare($query);

        var_dump($stmt);
     
        // bind values
        foreach ($columnsValue as $column => $value) {
            if($column == "location") {
                $location = explode(', ', $value);
                $stmt->bindValue(":x", $location[0]);
                $stmt->bindValue(":y", $location[1]);
            } else {
                $stmt->bindValue(":$column", $value);
            }
        }

        if($stmt->execute()){
            $query = "SELECT * FROM "
                      . $modal->tableName .
                " WHERE";

            foreach ($columnsValue as $column => $value) {
                if($column == "location") {
                    $query .= " $column = POINT(:x, :y)";
                } else {
                    $query .= " $column = :$column";
                }
                if($value != end($columnsValue)) {
                    $query .= " AND";
                }
            }
            $stmt = $modal->conn->prepare($query);

            foreach ($columnsValue as $column => $value) {
                if($column == "location") {
                    $stmt->bindValue(":x", $location[0]);
                    $stmt->bindValue(":y", $location[1]);
                } else {
                    $stmt->bindValue(":$column", $value);
                }
            }
            
            if($stmt->execute()){
                $num = $stmt->rowCount();
                if($num > 0){
                 
                    $products_arr=array();
                    $products_arr["records"]=array();
                 
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        if(isset($row["location"])) {
                            $row["location"] = "[$location[0], $location[1]]";
                        }
                        array_push($products_arr["records"], $row);
                    }

                    echo json_encode(
                        $products_arr, 
                        JSON_PRETTY_PRINT
                    );
                }
            } else {
                echo json_encode(
                    array("errorInfo" => $stmt->errorInfo()[2]), 
                    JSON_PRETTY_PRINT
                );
            }
        }  else {
            echo json_encode(
                array("message" => "No records added.", 
                    "errorInfo" => $stmt->errorInfo()[2]), 
                JSON_PRETTY_PRINT
            );
        }
    }
}