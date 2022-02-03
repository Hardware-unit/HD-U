<?php
    require_once("db.php");

    $sql = "DELETE FROM `panier` WHERE ID_user = " . $_GET["id"];
    echo $sql;

    $conn->query($sql);
    header("location:index.php");
    ?>
