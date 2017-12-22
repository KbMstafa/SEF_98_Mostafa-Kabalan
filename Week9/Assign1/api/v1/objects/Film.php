<?php
require_once 'config'.DIRECTORY_SEPARATOR.'Database.php';

class Film {

    public $conn;
    public $tableName = "film";

    public $primaryKey = "film_id";
    public $columns = [
        "title",
        "description",                  //NULL
        "release_year",                 //NULL
        "language_id",
        "original_language_id",         //NULL
        "rental_duration",
        "rental_rate",
        "length",                       //NULL
        "replacement_cost",
        "rating",                       //NULL
        "special_features"              //NULL

    ];

    public function connect($db){
        $this->conn = $db;
    }

    /*function all(){
    
        $query = "SELECT
                      *
                  FROM "
                      . $this->table_name .
                " ORDER BY
                    film_id DESC";

        $stmt = $this->conn->prepare($query);
    
        $stmt->execute();

        return $stmt;
    }*/
}
