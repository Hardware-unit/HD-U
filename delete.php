<?php
    require_once("db.php");
    require_once("login/user_info.php");
    getUserInfo();

    $sql = "DELETE FROM `panier` WHERE ID_article = " . $_GET["id"] . " AND ID_user = " . $USER_INFO->getID() ;

    $conn->query($sql);
    header("location:basket.php");
?>