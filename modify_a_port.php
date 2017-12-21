<?php
    include_once("database/singleton.php");
    error_reporting(0);
	$id = $_POST["id"];
    $port = $_POST["port"];
    $type = $_POST["type"];
    $keyword = $_POST["keyword"];
    $description = $_POST["description"];
	$virus = $_POST["virus"];


	if(isset($id) && !empty($id)) {
		$con = Database::getConnection();
		if(isset($port) && !empty($port)) {
			$req_update_port = $con->prepareDB("UPDATE `virus` SET `port`=? WHERE `id`=?");
			$req_update_port->bindParam(1, $port);
			$req_update_port->bindParam(2, $id);
			$req_update_port->execute();
		}
		if(isset($type) && !empty($type)) {
			$req_update_type = $con->prepareDB("UPDATE `virus` SET `type`=? WHERE `id`=?");
			$req_update_type->bindParam(1, $type);
			$req_update_type->bindParam(2, $id);
			$req_update_type->execute();
		}
		if(isset($keyword) && !empty($keyword)) {
			$req_update_keyword = $con->prepareDB("UPDATE `virus` SET `keyword`=? WHERE `id`=?");
			$req_update_keyword->bindParam(1, $keyword);
			$req_update_keyword->bindParam(2, $id);
			$req_update_keyword->execute();
		}
		if(isset($description) && !empty($description)) {
			$req_update_description = $con->prepareDB("UPDATE `virus` SET `description`=? WHERE `id`=?");
			$req_update_description->bindParam(1, $description);
			$req_update_description->bindParam(2, $id);
			$req_update_description->execute();
		}
		if(isset($virus) && !empty($virus)) {
			$req_update_virus = $con->prepareDB("UPDATE `virus` SET `virus`=? WHERE `id`=?");
			$req_update_virus->bindParam(1, $virus);
			$req_update_virus->bindParam(2, $id);
			$req_update_virus->execute();
		}

        exit();
	}

?>