<?php
    include_once("database/singleton.php");
    error_reporting(0);
    $id = $_POST["id"];
    $con = Database::getConnection();
    $req= $con->prepareDB("DELETE FROM virus WHERE id = ?");
    $req->bindParam(1, $id);
    $req->execute();

    exit();
?>