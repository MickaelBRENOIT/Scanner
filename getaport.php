<?php
    include_once("database/singleton.php");
    error_reporting(0);
	
    $id = $_POST["id"];

    $con = Database::getConnection();
    $req = $con->prepareDB("SELECT * FROM virus WHERE id = ?");
    $req->bindParam(1, $id);


	
    if($req->execute()) {

        $result = $req->fetch(PDO::FETCH_ASSOC);

        if($result){
            $port = $result['port'];
            $type = $result['type'];
            $keyword = $result['keyword'];
            $description = $result['description'];
			$virus = $result['virus'];
            
            echo "$port&$type&$keyword&$description&$virus";
            exit();
        }
        exit();
    }

?>