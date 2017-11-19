<HTML>
    <?php
    session_start();
    require "MySQLWrap.php";
    $con = new MySQLWrap();
    $query ="SELECT 
                i.inventory_id, s.manager_staff_id
             FROM
                 store AS s,
                 inventory AS i
             WHERE
                 film_id = ? AND i.store_id = s.store_id
                 AND inventory_id NOT IN (SELECT DISTINCT
                         inventory_id
                     FROM
                                  rental
                     WHERE
                                  return_date IS NULL
                     ORDER BY inventory_id);";
    $invStaff = $con->selectInventory($query);
    $cusId = $_POST["customers"];
    $invId = $invStaff[0];
    $staffId = $invStaff[1];
    echo " </br> $invId";
    echo " </br> $cusId";
    echo " </br> $staffId";
    $query = "INSERT INTO rental (rental_date,
                                  inventory_id,
                                  customer_id,
                                  staff_id,
                                  last_update)
              VALUES (now(), ?, ?, ?, now());";
    $con->insertRental($query, $invId, $cusId, $staffId);
    ?>
</HTML>