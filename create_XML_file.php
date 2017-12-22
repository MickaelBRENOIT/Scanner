<?php

	include_once("database/singleton.php");
    
    $con = Database::getConnection();
    $req = $con->prepareDB("SELECT * FROM virus");
    $req->execute();
    
    $result = $req->fetchAll(PDO::FETCH_ASSOC);
	
	$myfile = fopen("upload/exported.xml", "w") or die("Unable to open file!");
	
	fwrite($myfile, "<PortList>");	
	
	foreach ($result as $row ) {
		fwrite($myfile, "<Row>");
		
		fwrite($myfile, "<Port>".$row["port"]."</Port>");
		fwrite($myfile, "<Prot>".$row["type"]."</Prot>");
		
		if(isset($row["keyword"]) && !empty($row["keyword"]))
			fwrite($myfile, $row["keyword"]);
		
		if(isset($row["description"]) && !empty($row["description"]))
			fwrite($myfile, $row["description"]);
		
		if(isset($row["virus"]) && !empty($row["virus"]))
			fwrite($myfile, $row["virus"]);
		
		fwrite($myfile, "</Row>");
	}

	fwrite($myfile, "</PortList>");
	
	fclose($myfile);
	
?>