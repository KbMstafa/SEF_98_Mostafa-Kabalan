<?php
require_once '../config/Database.php';

class Film {

    private $conn;
    private $table_name = "film";

    public $title;
    public $description;
    public $release_year;
    public $language_id;
    public $original_language_id;
    public $rental_duration;
    public $rental_rate;
    public $length;
    public $replacement_cost;
    public $rating;
    public $special_features;

    public function __construct($db){
        $this->conn = $db;
    }

    function all(){
    
        $query = "SELECT
                      title,
                      description,
                      release_year,
                      language_id,
                      original_language_id,
                      rental_duration,
                      rental_rate,
                      length,
                      replacement_cost,
                      rating,
                      special_features
                  FROM "
                      . $this->table_name .
                " ORDER BY
                    film_id DESC";

        $stmt = $this->conn->prepare($query);
    
        $stmt->execute();

        return $stmt;
    }

    function create(
        $title,
        $description = NULL,
        $release_year = NULL,
        $language_id,
        $original_language_id = NULL,
        $rental_duration,
        $rental_rate,
        $length = NULL,
        $replacement_cost,
        $rating = NULL,
        $special_features = NULL
    ){
    
        $query = "INSERT INTO "
                  . $this->table_name .
                " SET
                    title = :title,
                    description = :description,
                    release_year = :release_year,
                    language_id = :language_id,
                    original_language_id = :original_language_id,
                    rental_duration = :rental_duration,
                    rental_rate = :rental_rate,
                    length = :length,
                    replacement_cost = :replacement_cost,
                    rating = :rating,
                    special_features = :special_features";
    
        $stmt = $this->conn->prepare($query);
     
        // bind values
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":release_year", $release_year);
        $stmt->bindParam(":language_id", $language_id);
        $stmt->bindParam(":original_language_id", $original_language_id);
        $stmt->bindParam(":rental_duration", $rental_duration);
        $stmt->bindParam(":rental_rate", $rental_rate);
        $stmt->bindParam(":length", $length);
        $stmt->bindParam(":replacement_cost", $replacement_cost);
        $stmt->bindParam(":rating", $rating);
        $stmt->bindParam(":special_features", $special_features);
    
        if($stmt->execute()){
            $query = "SELECT
                          *
                  FROM "
                      . $this->table_name .
                " WHERE
                      title = :title AND
                      description = :description AND
                      release_year = :release_year AND
                      language_id = :language_id AND
                      original_language_id = :original_language_id AND
                      rental_duration = :rental_duration AND
                      rental_rate = :rental_rate AND
                      length = :length AND
                      replacement_cost = :replacement_cost AND
                      rating = :rating AND
                      special_features = :special_features";
    
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":release_year", $release_year);
            $stmt->bindParam(":language_id", $language_id);
            $stmt->bindParam(":original_language_id", $original_language_id);
            $stmt->bindParam(":rental_duration", $rental_duration);
            $stmt->bindParam(":rental_rate", $rental_rate);
            $stmt->bindParam(":length", $length);
            $stmt->bindParam(":replacement_cost", $replacement_cost);
            $stmt->bindParam(":rating", $rating);
            $stmt->bindParam(":special_features", $special_features);
            
            $stmt->execute();

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
            }
        }  else {
            echo json_encode(
                array("message" => "No films added."), 
                JSON_PRETTY_PRINT
            );
        }
    }
}


$title = trim(fgets(STDIN));
$description = trim(fgets(STDIN));
$release_year = trim(fgets(STDIN));
$language_id = trim(fgets(STDIN));
$original_language_id = trim(fgets(STDIN));
$rental_duration = trim(fgets(STDIN));
$rental_rate = trim(fgets(STDIN));
$length = trim(fgets(STDIN));
$replacement_cost = trim(fgets(STDIN));
$rating = trim(fgets(STDIN));
$special_features = trim(fgets(STDIN));

$database = new Database;
$db = $database->getConnection() ;

$customer = new Film($db);
$customer->create(
    $title,
    $description,
    $release_year,
    $language_id,
    $original_language_id,
    $rental_duration,
    $rental_rate,
    $length,
    $replacement_cost,
    $rating,
    $special_features
);
