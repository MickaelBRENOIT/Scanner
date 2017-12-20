<?php
    include_once("database/singleton.php");
    error_reporting(0);
    
    $con = Database::getConnection();
    $req = $con->prepareDB("SELECT * FROM roles");
    $req->execute();
    
    $result = $req->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($result as $row ) {
        echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
    }

?>