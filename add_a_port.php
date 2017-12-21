<?php
    include_once("database/singleton.php");
    error_reporting(0);
    $port = $_POST["port"];
    $type = $_POST["type"];
    $keyword = $_POST["keyword"];
    $description = $_POST["description"];
	$virus = $_POST["virus"];

	if(isset($port) && !empty($port) && isset($type) && !empty($type)) {
		$con = Database::getConnection();
		$req_create = $con->prepareDB("INSERT INTO `virus`(`port`, `type`, `keyword`, `description`, `virus`) VALUES (?,?,?,?,?)");
		$req_create->bindParam(1, $port);
        $req_create->bindParam(2, $type);
        $req_create->bindParam(3, $keyword);
        $req_create->bindParam(4, $description);
		$req_create->bindParam(5, $virus);
		$req_create->execute();
        exit();
	}
?>