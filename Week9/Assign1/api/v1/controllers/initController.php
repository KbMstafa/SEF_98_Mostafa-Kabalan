<?php
foreach (scandir('objects') as $filename) {
    $path = 'objects'.DIRECTORY_SEPARATOR.$filename;
    if (is_file($path)) {
        require_once $path;
    }
}

class initController {

    public function create($model) {

        $database = new Database;
        $db = $database->getConnection() ;

        foreach ($_POST as $column => $value) {
            if(in_array($column, $model->columns)) {
                $columnsValue[$column] = $value;
            }
        }
        
        $model->connect($db);
    
        $query = "INSERT INTO "
                  . $model->tableName .
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
    
        $stmt = $model->conn->prepare($query);
     
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
                      . $model->tableName .
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

            $stmt = $model->conn->prepare($query);

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
                    array("errorCode" => $stmt->errorInfo()[0], 
                        "errorInfo" => $stmt->errorInfo()[2]), 
                    JSON_PRETTY_PRINT
                );
            }
        }  else {
            echo json_encode(
                array("message" => "No records added.", 
                    "errorCode" => $stmt->errorInfo()[0], 
                    "errorInfo" => $stmt->errorInfo()[2]), 
                JSON_PRETTY_PRINT
            );
        }
    }

    public function deleteIfId($model, $id) {
        
        if(preg_match('/^[0-9]+$/', $id)) {

            $database = new Database;
            $db = $database->getConnection() ;

            $model->connect($db);

            $query = "DELETE FROM "
                      . $model->tableName .
                    " WHERE "
                      . $model->primaryKey .
                    " = :id";

            $stmt = $model->conn->prepare($query);

            $stmt->bindValue(":id", $id);

            if($stmt->execute()) {
                echo json_encode(
                    array("message" => $model->tableName." deleted"), 
                    JSON_PRETTY_PRINT
                );
            }  else {
                echo json_encode(
                    array("message" => "No ".$model->tableName." deleted.", 
                        "errorCode" => $stmt->errorInfo()[0], 
                        "errorInfo" => $stmt->errorInfo()[2]), 
                    JSON_PRETTY_PRINT
                );
            }
        } else {
            echo json_encode(
                array("message" => "$id must be an integer number (id)"), 
                JSON_PRETTY_PRINT
            );
        }
    }

    public function delete($model) {

        $database = new Database;
        $db = $database->getConnection() ;

        foreach ($_GET as $column => $value) {
            if(in_array($column, $model->columns)
                || $column == $model->primaryKey) {
                $columnsValue[$column] = $value;
            }
        }

        var_dump($columnsValue);
        
        $model->connect($db);

        $query = "DELETE FROM "
                      . $model->tableName .
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

        $stmt = $model->conn->prepare($query);
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

        if($stmt->execute()) {
            echo json_encode(
                array("message" => $model->tableName." deleted"), 
                JSON_PRETTY_PRINT
            );
        }  else {
            echo json_encode(
                array("message" => "No ".$model->tableName." deleted.", 
                    "errorCode" => $stmt->errorInfo()[0], 
                    "errorInfo" => $stmt->errorInfo()[2]), 
                JSON_PRETTY_PRINT
            );
        }
    }
}