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
        
        $dbCon->Close();
        ?>
    </form>
</HTML>