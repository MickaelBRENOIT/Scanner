<?php
    include_once("database/singleton.php");
    //error_reporting(0);
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm = $_POST["confirm"];

    if(isset($username) && isset($password) && isset($confirm) && !empty($username) && !empty($password) && !empty($confirm)){
        
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
            $passwordClean = filter_var($username, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
            $hash=md5($passwordClean);
            
            $req_create = $con->prepareDB("INSERT INTO users (username, password) VALUES (? , ?)");
            $req_create->bindParam(1, $usernameClean);
            $req_create->bindParam(2, $hash);
            $req_create->execute();
            exit();
        }
    }
?>