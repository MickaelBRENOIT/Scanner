<?php
    include_once("database/singleton.php");
    error_reporting(0);
    $username = $_POST["username"];
    $con = Database::getConnection();
    $req= $con->prepareDB("DELETE FROM users WHERE username = ?");
    $req->bindParam(1, $username);
    $req->execute();

    exit();
?>