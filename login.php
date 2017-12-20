<?php 

    include_once("database/singleton.php");
    error_reporting(0);

    $login = $_POST["login"];
    $passw = $_POST["passw"];
   
    if(isset($login) && isset($passw) && !empty($login) && !empty($passw)){
        $con = Database::getConnection();
        $usernameClean = filter_var($login, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        $get_hash = $con->prepareDB("SELECT * FROM users WHERE username = ? AND active='Yes' ");
        $get_hash->bindParam(1, $usernameClean);
        $get_hash->execute();
        
        $row = $get_hash->fetch(PDO::FETCH_ASSOC);
        
        if(password_verify($passw,$row['password'])){
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $row['username'];
            $_SESSION['memberID'] = $row['id'];
            $_SESSION['role'] = $row['id_role'];
            echo "state:ok";
            exit();
        }
    }

?>