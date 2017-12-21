<?php
    include_once("database/singleton.php");
    
    $con = Database::getConnection();
    $req = $con->prepareDB("SELECT * FROM virus");
    $req->execute();
    
    $result = $req->fetchAll(PDO::FETCH_ASSOC);

    echo "<table class=\"table table-striped\">\n";
    echo "<thead>\n";
    echo "<tr>\n";
    echo "<th scope=\"col\">Port</th>\n";
    echo "<th scope=\"col\">Protocol</th>\n";
    echo "<th scope=\"col\">Keyword</th>\n";
    echo "<th scope=\"col\">Description</th>\n";
    echo "<th scope=\"col\">Viruses</th>\n";
	echo "<th scope=\"col\">Actions</th>\n";
    echo "</tr>\n";
    echo "</thead>\n";
    echo "<tbody>";
	
    foreach ($result as $row ) {
        echo "<tr>";
        echo "<th scope=\"row\">".$row["port"]."</th>";
        echo "<td>".$row["type"]."</td>";
        echo "<td>".$row["keyword"]."</td>";
        echo "<td>".$row["description"]."</td>";
		echo "<td>".$row["virus"]."</td>";
		echo "<td>";
        echo '<button type="submit" class="modifyport btn btn-warning" value="'.$row["id"].'" >Modify</button>';
        echo "&nbsp;&nbsp;";
        echo '<button type="submit" class="deleteport btn btn-danger" value="'.$row["id"].'" >Delete</button>';
        echo "</td>";
        echo "</tr>";
    }

    echo "</tbody>\n";
    echo "</table>";

?>