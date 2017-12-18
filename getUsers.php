<?php 
 include_once("database/singleton.php");
    error_reporting(0);

$result_array = array();

        $con = Database::getConnection();
      
        $get_hash = $con->prepareDB("SELECT * FROM users ;");
        $get_hash->execute();
        
        while ($row = $get_hash->fetch(PDO::FETCH_ASSOC)){
        	     array_push($result_array, $row);
        }

/* send a JSON encded array to client */
echo json_encode($result_array);


