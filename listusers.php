<?php
    include_once("database/singleton.php");
    error_reporting(E_ALL);
    
    $con = Database::getConnection();
    $req = $con->prepareDB("SELECT * FROM users INNER JOIN roles WHERE users.id_role = roles.id");
    $req->execute();
    
    $result = $req->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($result as $row ) {
        
  }
?>