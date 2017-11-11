<?php
    include_once("database/singleton.php");
    //error_reporting(0);
    //collect values from the url
    $id = trim($_GET['x']);
    $active = trim($_GET['y']);

    if(isset($id) && isset($active) && !empty($active) && is_numeric($id)){
        $con = Database::getConnection();
        $req = $con->prepareDB("UPDATE users SET active = 'Yes' WHERE id = ? and active = ?");
        $req->bindParam(1, $id);
        $req->bindParam(2, $active);
        $req->execute();
        
        if($req->rowCount() == 1){
            echo "<script type='text/javascript'>window.location.href = 'index.php?action=activated';</script>";
            exit();
        } else {
            echo "<script type='text/javascript'>window.location.href = 'index.php?action=notactivated';</script>";
            exit();
        }
    }
?>