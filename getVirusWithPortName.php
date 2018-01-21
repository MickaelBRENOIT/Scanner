<?php
	include_once("database/singleton.php");
    error_reporting(0);
	
	$port = $_POST["id"];
	
	$bepis="";
	
	if(isset($port) && !empty($port)){
		foreach($port as $value){
			$con = Database::getConnection();
			$req_id = $con->prepareDB("SELECT virus FROM virus WHERE port = ?");
			$req_id->bindParam(1, $value);
			$req_id->execute();
			
			$result = $req_id->fetch(PDO::FETCH_ASSOC);
			$virus = $result["virus"];
			if(isset($virus) && !empty($virus)){
				$bepis.="Your port $value is open, that's why you are vulnerable to $virus";
				$bepis.="&";				
			}
		}
		error_log(substr($bepis, 0, -1));
		echo substr($bepis, 0, -1);
		exit();
	}
	
	
?>