<?php
    include_once("database/singleton.php");
    error_reporting(0);
    $username = $_POST["username"];

    $con = Database::getConnection();
    $req = $con->prepareDB("SELECT * FROM users WHERE username = ?");
    $req->bindParam(1, $username);
    if($req->execute()) {
        $result = $req->fetch(PDO::FETCH_ASSOC);

        if($result){
            $username = $result['username'];
            $email = $result['email'];
            $active = $result['active'];
            $role = $result['id_role'];
            
            echo "$username&$email&$active&$role";
            exit();
        }
        exit();
    }

?>