<?php
    require_once("db.php");
    require_once("login/user_info.php");
    getUserInfo();

  json_decode(file_get_contents("http://localhost/dev/Hardware_Unit/API_HU/user/" . $_GET['id']));

    header("location:nos_utilisateur.php");
?>
test