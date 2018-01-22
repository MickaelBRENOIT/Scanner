<?php
    include_once("header.php");
?>

<div class="container mt-3 mb-3">
    <div class="text-center">
        <h1>Your scans</h1>
    </div>
</div>

<hr style="display: block; margin-top: 0.5em; margin-bottom: 0.5em; margin-left: auto; margin-right: auto; border-style: inset; border-width: 1px;">

<?php
	include_once("database/singleton.php");
    
	$user=$_SESSION["username"];
	
    $con = Database::getConnection();
	
	//Permet d'avoir le nombre de scan effectué par l'utilisateur
	$req_count = $con->prepareDB("SELECT scanDate from  savedport WHERE userId=(SELECT id FROM users WHERE username='$user')");
	$req_count->execute();
	$result=$req_count->fetchAll(PDO::FETCH_ASSOC);
	?>
	<!--
	foreach($result as $value) {
		foreach($value as $v){
			echo $v." : ";
			$req_get_port = $con->prepareDB("SELECT port FROM virus INNER JOIN savedport ON virus.id=savedport.virusId WHERE savedport.userId=(SELECT id FROM users WHERE username='$user') and savedport.scanDate='$v'");
			$req_get_port->execute();
			$result2=$req_get_port->fetchAll(PDO::FETCH_ASSOC);
			var_dump($result2);
		}
	}
	
	
	
    /*$req = $con->prepareDB("SELECT * FROM savedport INNER JOIN roles WHERE users.id_role = roles.id ORDER BY users.username ASC");
    $req->execute();
    
    $result = $req->fetchAll(PDO::FETCH_ASSOC);*/
?>-->

<div id="table-scan" class="container"> 
	<table class="table table-striped">
        <thead>
			<tr>
				<th scope=\"col\">Date</th>
				<th scope=\"col\">Opened ports</th>
			</tr>
        </thead>
        <tbody>
			<?php foreach($result as $value) { ?>
				<tr>
				<?php foreach($value as $v){ ?>
					<th><?php echo $v; ?></th>
					<td><?php
					$req_get_port = $con->prepareDB("SELECT port FROM virus INNER JOIN savedport ON virus.id=savedport.virusId WHERE savedport.userId=(SELECT id FROM users WHERE username='$user') and savedport.scanDate='$v'");
					$req_get_port->execute();
					$result2=$req_get_port->fetchAll(PDO::FETCH_ASSOC);
					foreach($result2 as $v){
						foreach($v as $vamosALaPlaya){
							echo $vamosALaPlaya." ";
						}
					}
					?></td>
				<?php } ?>
				</tr>
			<?php } ?>
		</tbody>
</div>

<?php
    include_once("footer.php");
?>