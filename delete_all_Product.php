<?php
    require_once("db.php");

    $sql = "DELETE FROM `panier` WHERE ID_user = " . $_GET["id"];
    echo $sql;

    mysqli_query($conn, $sql);
    header("location:index.php");
    ?>
