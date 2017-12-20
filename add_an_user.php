<?php
    include_once("database/singleton.php");
    error_reporting(0);
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $role = $_POST["role"];
    $active = "Yes";

    if(isset($username) && isset($email) && isset($password) && !empty($username) && !empty($email) && !empty($password)){
        
        $usernameClean = filter_var($username, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        
        $con = Database::getConnection();
        $req_username = $con->prepareDB("SELECT username FROM users WHERE username = ?");
        $req_username->bindParam(1, $usernameClean);
        $req_username->execute();
        
        $result = $req_username->fetch(PDO::FETCH_ASSOC);
        if($result){
            echo $result["username"];
            exit();
        } else {
            $emailClean = filter_var($email, FILTER_SANITIZE_EMAIL);
            $hash = password_hash($password, PASSWORD_BCRYPT);
            
            $req_create = $con->prepareDB("INSERT INTO users (username, email, password, active, id_role) VALUES (? , ? , ? , ?, ?)");
            $req_create->bindParam(1, $usernameClean);
            $req_create->bindParam(2, $emailClean);
            $req_create->bindParam(3, $hash);
            $req_create->bindParam(4, $active);
			$req_create->bindParam(5, $role);
            $req_create->execute();
            exit();
        }
    }
?>