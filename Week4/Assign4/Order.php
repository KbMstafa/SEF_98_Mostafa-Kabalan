<HTML>
    <form name = "customer input" action = "OrderProcess.php" method = "post">
        <?php
        require_once "Config.php";
        $dbCon = new mysqli($host, $usrName, $usrPass, $dbName);
        if($dbCon->connect_error) {
            die($dbCon->connect_error);
        }
        else {
            echo "<H1>Welcome to sakila : \n</H1>";
        }
        $query = "SELECT 
                      f.film_id, f.title, 
                      f.rental_duration, f.rental_rate
                  FROM
                      film AS f,
                      inventory AS i
                  WHERE
                      i.film_id = f.film_id
                      AND inventory_id NOT IN (SELECT DISTINCT
                              inventory_id
                          FROM
                              rental
                          WHERE
                              return_date IS NULL
                          ORDER BY inventory_id)
                  GROUP BY i.film_id;";
        $result = $dbCon->prepare($query);
        $result->execute();
        $result-> bind_result($id, $title, $duration, $amount);
        echo "<select name = \"films\">";
        while ($result->fetch()) {
            echo "<option value='".$id."'>
                      $title &emsp; \"$amount for $duration days\"
                  </option>";
        }
        echo "</select></br></br>";
        $query = "SELECT 
                      customer_id, first_name, last_name
                  FROM
                      customer
                  WHERE
                      active = 1;";
        $result = $dbCon->prepare($query);
        $result->execute();
        $result-> bind_result($id, $firstname, $lastname);
        echo "<select name = \"customers\">";
        while ($result->fetch()) {
            echo "<option value='".$id."'>
                      $firstname $lastname
                  </option>";
        }
        echo "</select></br></br>";
        echo "<input type = 'submit' value = 'rent' name = 'rent'>";
        $dbCon->Close();
        ?>
    </form>
</HTML>