<?php
require_once "db.php";
require_once "login/user_info.php";
require_once "class/user.php";
require_once "info_panier.php";
?>
<!DOCTYPE html>
<html lang="FR">

<head>
    <meta charset="UTF-8">
    <title>Panier</title>
    <link rel="stylesheet" type="text/css" href="CSS/basket.css?v=<?= ver() ?>" />
    <link rel="icon" type="image/png" href="Image/HeadLogo.png" />
    <link rel="stylesheet" type="text/css" href="CSS/HomePage.css?v=<?= ver() ?>" />
</head>

<body>
    <?php
    getUserInfo();
    getPanierInfo();
    if ($USER_INFO->getID() >= 1) {
        require_once("header.php");
        
    ?>
        <div class="contenu">


        </div>
    <?php
        require_once("footer.php");
    } else {
    ?>
        <div class="info_noConnect">
            <div class="no_connect">Vous n'êtes pas connecté(es).<a href="../login/connexion.php">Veuillez vous connecter</a> ou vous ne disposer pas de droit permettent d'ouvrir cette page.</div>
        </div>
    <?php
    }
    ?>
</body>

</html>