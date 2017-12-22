<?php

class initController {

    public function buildQuery($query, $arrayOfColumns, $separator) {
        foreach ($arrayOfColumns as $column => $value) {
            if($column == "location") {
                $query .= " $column = POINT(:x, :y)";
            } else {
                $query .= " $column = :$column";
            }
            if($value != end($arrayOfColumns)) {
                $query .= $separator;
            }
        }
        return $query;
    }

    public function bindColumnsValues($stmt, $arrayOfColumns) {
        foreach ($arrayOfColumns as $column => $value) {
            if($column == "location") {
                $location = explode(', ', $value);
                $stmt->bindValue(":x", $location[0]);
                $stmt->bindValue(":y", $location[1]);
            } else {
                $stmt->bindValue(":$column", $value);
            }
        }
        return $location;
    }

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

        $query = $this->buildQuery($query, $columnsValue, ",");
    
        $stmt = $model->conn->prepare($query);
     
        $location = $this->bindColumnsValues($stmt, $columnsValue);

        if($stmt->execute()){
            $query = "SELECT * FROM "
                      . $model->tableName .
                " WHERE";

            $query = $this->buildQuery($query, $columnsValue, " AND");

            $stmt = $model->conn->prepare($query);

            $this->bindColumnsValues($stmt, $columnsValue);
            
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

                    header('Content-Type: application/json');
                    echo json_encode(
                        $products_arr, 
                        JSON_PRETTY_PRINT
                    );
                }
            } else {

                header('Content-Type: application/json');
                echo json_encode(
                    array("errorCode" => $stmt->errorInfo()[0], 
                        "errorInfo" => $stmt->errorInfo()[2]), 
                    JSON_PRETTY_PRINT
                );
            }
        }  else {

            header('Content-Type: application/json');
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

                header('Content-Type: application/json');
                echo json_encode(
                    array("message" => $model->tableName." deleted"), 
                    JSON_PRETTY_PRINT
                );
            }  else {

                header('Content-Type: application/json');
                echo json_encode(
                    array("message" => "No ".$model->tableName." deleted.", 
                        "errorCode" => $stmt->errorInfo()[0], 
                        "errorInfo" => $stmt->errorInfo()[2]), 
                    JSON_PRETTY_PRINT
                );
            }
        } else {

            header('Content-Type: application/json');
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
        
        $model->connect($db);

        $query = "DELETE FROM "
                      . $model->tableName .
                    " WHERE";

        $query = $this->buildQuery($query, $columnsValue, " AND");

        $stmt = $model->conn->prepare($query);

        $this->bindColumnsValues($stmt, $columnsValue);

        if($stmt->execute()) {

            header('Content-Type: application/json');
            echo json_encode(
                array("message" => $model->tableName." deleted"), 
                JSON_PRETTY_PRINT
            );
        }  else {

            header('Content-Type: application/json');
            echo json_encode(
                array("message" => "No ".$model->tableName." deleted.", 
                    "errorCode" => $stmt->errorInfo()[0], 
                    "errorInfo" => $stmt->errorInfo()[2]), 
                JSON_PRETTY_PRINT
            );
        }
    }

    public function patch($model, $id) {

        if(preg_match('/^[0-9]+$/', $id)) {
            $database = new Database;
            $db = $database->getConnection() ;

            $model->connect($db);

            $input = file_get_contents('php://input');

            preg_match_all('/([a-z0-9_]+)"\s+([a-z0-9@.,_ ]+)/i', $input, $matches);

            for($column=0; $column<count($matches[0]); $column++) {
                $patch[$matches[1][$column]] = $matches[2][$column];
            }

            foreach ($patch as $column => $value) {
                if(in_array($column, $model->columns)
                    || $column == $model->primaryKey) {
                    $columnsValue[$column] = $value;
                }
            }

            $query = "UPDATE "
                      . $model->tableName .
                    " SET";

            $query = $this->buildQuery($query, $columnsValue, ",");

            $query .= " WHERE "
                        . $model->primaryKey .
                      " = :id";

            $stmt = $model->conn->prepare($query);

            $location = $this->bindColumnsValues($stmt, $columnsValue);

            $stmt->bindValue(":id", $id);

            if($stmt->execute()) {
                $query = "SELECT * FROM "
                      . $model->tableName .
                    " WHERE "
                      . $model->primaryKey .
                    " = :id";

                $stmt = $model->conn->prepare($query);

                $stmt->bindValue(":id", $id);

                if($stmt->execute()) {
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

                    header('Content-Type: application/json');
                    echo json_encode(
                        array("errorCode" => $stmt->errorInfo()[0], 
                            "errorInfo" => $stmt->errorInfo()[2]), 
                        JSON_PRETTY_PRINT
                    );
                }
            }  else {

                header('Content-Type: application/json');
                echo json_encode(
                    array("message" => "No ".$model->tableName." updated.", 
                        "errorCode" => $stmt->errorInfo()[0], 
                        "errorInfo" => $stmt->errorInfo()[2]), 
                    JSON_PRETTY_PRINT
                );
            }

        } else {

            header('Content-Type: application/json');
            echo json_encode(
                array("message" => "$id must be an integer number (id)"), 
                JSON_PRETTY_PRINT
            );
        }
    }

    public function put($model, $id) {

        if(preg_match('/^[0-9]+$/', $id)) {
            $database = new Database;
            $db = $database->getConnection() ;

            $model->connect($db);

            $input = file_get_contents('php://input');

            preg_match_all('/([a-z0-9_]+)"\s+([a-z0-9@.,_ ]+)/i', $input, $matches);

            for($column=0; $column<count($matches[0]); $column++) {
                $put[$matches[1][$column]] = $matches[2][$column];
            }

            foreach ($model->columns as $column) {
                    $columnsValue[$column] = $put[$column];
            }

            $query = "UPDATE "
                      . $model->tableName .
                    " SET";

            $query = $this->buildQuery($query, $columnsValue, ",");

            $query .= " WHERE "
                        . $model->primaryKey .
                      " = :id";

            $stmt = $model->conn->prepare($query);

            $location = $this->bindColumnsValues($stmt, $columnsValue);

            $stmt->bindValue(":id", $id);

            if($stmt->execute()) {
                $query = "SELECT * FROM "
                      . $model->tableName .
                    " WHERE "
                      . $model->primaryKey .
                    " = :id";

                $stmt = $model->conn->prepare($query);

                $stmt->bindValue(":id", $id);

                if($stmt->execute()) {
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

                    header('Content-Type: application/json');
                    echo json_encode(
                        array("errorCode" => $stmt->errorInfo()[0], 
                            "errorInfo" => $stmt->errorInfo()[2]), 
                        JSON_PRETTY_PRINT
                    );
                }
            }  else {

                header('Content-Type: application/json');
                echo json_encode(
                    array("message" => "No ".$model->tableName." updated.", 
                        "errorCode" => $stmt->errorInfo()[0], 
                        "errorInfo" => $stmt->errorInfo()[2]), 
                    JSON_PRETTY_PRINT
                );
            }
        } else {

            header('Content-Type: application/json');
            echo json_encode(
                array("message" => "$id must be an integer number (id)"), 
                JSON_PRETTY_PRINT
            );
        }
    }
}