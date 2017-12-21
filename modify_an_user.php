<?php
    include_once("database/singleton.php");
    error_reporting(0);
    $username = $_POST["username"];
    $email = $_POST["email"];
    $activate = $_POST["activate"];
    $password = $_POST["password"];
    $role = $_POST["role"];

    if(isset($activate) && isset($email) && isset($password) && !empty($email) && !empty($password)){
        
        $activateClean = filter_var($activate, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        $emailClean = filter_var($email, FILTER_SANITIZE_EMAIL);
        $hash = password_hash($password, PASSWORD_BCRYPT);
        
        $con = Database::getConnection();
        
        $req_create = $con->prepareDB("UPDATE users SET email = ?, password = ?, active = ?, id_role = ? WHERE username = ?");
        $req_create->bindParam(1, $emailClean);
        $req_create->bindParam(2, $hash);
        $req_create->bindParam(3, $activate);
        $req_create->bindParam(4, $role);
        $req_create->bindParam(5, $username);
        $req_create->execute();
        exit();
    }
?>