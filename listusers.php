<?php
    include_once("database/singleton.php");
    error_reporting(E_ALL);
    
    $con = Database::getConnection();
    $req = $con->prepareDB("SELECT * FROM users INNER JOIN roles WHERE users.id_role = roles.id ORDER BY users.username ASC");
    $req->execute();
    
    $result = $req->fetchAll(PDO::FETCH_ASSOC);

    echo "<table class=\"table table-striped\">\n";
    echo "<thead>\n";
    echo "<tr>\n";
    echo "<th scope=\"col\">Username</th>\n";
    echo "<th scope=\"col\">Mail</th>\n";
    echo "<th scope=\"col\">Active</th>\n";
    echo "<th scope=\"col\">Role</th>\n";
    echo "<th scope=\"col\">Actions</th>\n";
    echo "</tr>\n";
    echo "</thead>\n";
    echo "<tbody>";
    
    foreach ($result as $row ) {
        echo "<tr>";
        echo "<th scope=\"row\">".$row["username"]."</th>";
        echo "<td>".$row["email"]."</td>";
        echo "<td>".$row["active"]."</td>";
        echo "<td>".$row["name"]."</td>";
        echo "<td>";
        echo '<button class="modifyuser btn btn-warning" value="'.$row["username"].'" >Modify</button>';
        echo "&nbsp;&nbsp;";
        echo '<button class="deleteuser btn btn-danger" value="'.$row["username"].'" >Delete</button>';
        echo "</td>";
        echo "</tr>";
    }

    echo "</tbody>\n";
    echo "</table>";

?>