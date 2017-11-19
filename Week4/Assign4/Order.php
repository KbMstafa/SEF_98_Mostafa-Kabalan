<HTML>
    <form name = "customer input" action = "OrderProcess.php" method = "post">
        <?php
        require_once "Config.php";
        require "MySQLWrap.php";
        $con = new MySQLWrap();
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
        echo "<b>Choose a film to rent :</b><br>";
        echo "<select name = \"films\">";
        $films = $con->selectFilms($query);
        foreach ($films as $filmInfo) {
            echo "<option value='".$filmInfo[0]."'>
                      $filmInfo[1]
                  </option>";
        }
        $query = "SELECT 
                      customer_id, first_name, last_name
                  FROM
                      customer
                  WHERE
                      active = 1
                  ORDER BY first_name;";
        echo "<select name = \"customers\">";
        $customers = $con->selectCustomers($query);
        foreach ($customers as $customerInfo) {
            echo "<option value='".$customerInfo[0]."'>
                      $customerInfo[1]
                  </option>";
        }
        echo "</select></br></br>";
        echo "<input type = 'submit' value = 'rent' name = 'rent'>";
        $dbCon->Close();
        ?>
    </form>
</HTML>