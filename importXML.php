<?php
	include_once("database/singleton.php");
	$filename = $_FILES["xml"]["name"];
    $filetype = $_FILES["xml"]["type"];
    $filesize = $_FILES["xml"]["size"];

	
// Check if the form was submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Check if file was uploaded without errors
    if(isset($_FILES["xml"]) && $_FILES["xml"]["error"] == 0){
		
        $allowed = array("xml" => "text/xml");
        $filename = $_FILES["xml"]["name"];
        $filetype = $_FILES["xml"]["type"];
        $filesize = $_FILES["xml"]["size"];
		
    
        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
    
        // Verify MYME type of the file
        if(in_array($filetype, $allowed)){
            // Check whether file exists before uploading it
            if(file_exists("upload/" . $_FILES["xml"]["name"])){
                echo $_FILES["xml"]["name"] . " is already exists.<br/><br/>";
            } else{
                move_uploaded_file($_FILES["xml"]["tmp_name"], "upload/" . $_FILES["xml"]["name"]);
                echo "Your file was uploaded successfully.";
            } 
        } else{
            echo "Error: There was a problem uploading your file. Please try again."; 
        }
    } else{
        echo "Error: " . $_FILES["xml"]["error"];
    }
}

//Vérifie si un fichier a été upload puis vérifie si le fichier uploadé existe bien dans le dossier upload.
if(isset($_FILES["xml"]) && file_exists("upload/".$_FILES["xml"]["name"])) {

	$filename = "upload/".$_FILES["xml"]["name"];
	$file = fopen($filename, 'r');
	$data = fread($file,filesize($filename));
	
	$xml=simplexml_load_string(utf8_encode($data)) or die("Error: Cannot create object");
	
	$con = new mysqli("localhost", "root", "", "scanner");
	$keys = ["Port", "Type", "Keyword", "Description", "Virus"];
	$blank = "";
	
	$req_delete = $con->prepare("TRUNCATE TABLE`virus`");
	$req_delete->execute();
	
	$req_insert_virus = $con->prepare("INSERT INTO `virus`(`port`, `type`, `keyword`, `description`, `virus`) VALUES (?,?,?,?,?)");
	$req_insert_virus->bind_param("issss",$port, $type, $keyword, $description, $virus);
	
	foreach($xml as $value){
		$port = 0;
		$type = "";
		$keyword = "";
		$description = "";
		$virus = "";
		foreach($value as $k => $v){
			if($k=="Port") {
				$port = $v;
			}
			if($k=="Prot") {
				$type = $v;
			}
			if($k=="Keyword") {
				$keyword = $v;
			}
			if($k=="Description") {
				$description = $v;
			}
			if($k=="Trojan_info") {
				$virus = $v;
			}
		}
		$req_insert_virus->execute();
	}
	
	/*$port = 0;
	$type = "";
	$keyword = "";
	$description = "";
	$virus = "";
	
	$con = Database::getConnection();
	$req_insert_virus = $con->prepareDB("INSERT INTO `virus`(`Port`, `Type`, `Keyword`, `Description`, `Virus`) VALUES (?,?,?,?,?)");
	
	$req_insert_virus->bindParam(1, $port);
    $req_insert_virus->bindParam(2, $type);
    $req_insert_virus->bindParam(3, $keyword);
    $req_insert_virus->bindParam(4, $description);
	$req_insert_virus->bindParam(5, $virus);
	
	foreach($xml as $value){
		$port = 0;
		$type = "";
		$keyword = "";
		$description = "";
		$virus = "";
		foreach($value as $k => $v){
			if($k=="Port") {
				$port = $v;
			}
			if($k=="Prot") {
				$type = $v;
			}
			if($k=="Keyword") {
				$keyword = $v;
			}
			if($k=="Description") {
				$description = $v;
			}
			if($k=="Trojan_info") {
				$virus = $v;
			}
		}
		$req_insert_virus->execute();
	}
	*/
}

function Redirect($url, $permanent = false)
{
    header('Location: ' . $url, true, $permanent ? 301 : 302);

    exit();
}

Redirect("http://127.0.0.1/Scanner/port_list.php", false);

?>