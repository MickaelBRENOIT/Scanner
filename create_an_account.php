<?php
    include_once("database/singleton.php");
    //error_reporting(0);
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm = $_POST["confirm"];

    if(isset($username) && isset($email) && isset($password) && isset($confirm) && !empty($username) && !empty($email) && !empty($password) && !empty($confirm)){
        
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
            $passwordClean = filter_var($username, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
            $hash = password_hash($passwordClean, PASSWORD_BCRYPT);
            $rand_active = md5(uniqid(rand(),true));
            
            $req_create = $con->prepareDB("INSERT INTO users (username, email, password, active) VALUES (? , ? , ? , ?)");
            $req_create->bindParam(1, $usernameClean);
            $req_create->bindParam(2, $emailClean);
            $req_create->bindParam(3, $hash);
            $req_create->bindParam(4, $rand_active);
            $req_create->execute();
            
            $id = $con->myLastInsertId();
            $to = $emailClean;
            $subject = "Registration Confirmation";
            $body = "<h2>Thank you for registering at demo site.</h2>
                     <p>To activate your account, please click on this link: <a href='127.0.0.1/Scanner/activate.php?x=$id&y=$rand_active'>127.0.0.1/Scanner/activate.php?x=$id&y=$rand_active</a></p>
                     <p>Regards Site Admin</p>";
            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            mail($to, $subject, $body, $headers);
            exit();
        }
    }
?>