<?php
	include_once("database/singleton.php");
    error_reporting(0);
	
	$port = $_POST["id"];
	$userName = $_POST["userName"];
	
	if(isset($port) && !empty($port) && isset($userName) && !empty($userName)){
		foreach($port as $value){
			$con = Database::getConnection();
			$req_id = $con->prepareDB("SELECT id FROM virus WHERE port = ?");
			$req_id->bindParam(1, $value);
			$req_id->execute();
			
			$result = $req_id->fetch(PDO::FETCH_ASSOC);
			$id = $result["id"];
			error_log($id);
			
			//$req_create = $con->prepareDB("INSERT INTO savedport (userId, virusId, scanDate) SELECT (SELECT id from users WHERE username='$userName'), id FROM virus WHERE id = ?, NOW()");
			$req_create = $con->prepareDB("INSERT INTO `savedport`(`userId`, `virusId`, `scanDate`) VALUES ((SELECT id from users WHERE username='$userName'),(SELECT id FROM virus WHERE id = ?),(SELECT NOW()))");
			$req_create->bindParam(1, $id);
			$req_create->execute();
		}
		exit();
	}
	
	
?>