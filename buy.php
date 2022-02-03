<?php
require_once("db.php");
require_once("login/user_info.php");
require_once("info_panier.php");
?>
<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <title>Achat</title>
    <link rel="stylesheet" type="text/css" href="CSS/basket.css?v=<?= ver() ?>" />
    <link rel="icon" type="image/png" href="Image/HeadLogo.png" />
    <link rel="stylesheet" type="text/css" href="CSS/HomePage.css?v=<?= ver() ?>" />
</head>

<body>
    <?php
    getUserInfo();
    getPanierInfo();
    require_once("header.php");
    ?>


    <?php
    if (count($_POST) > 0) {
        $liv_adress = $_POST["livraison"];
        $CB = $_POST["CB"];
        $fac_adress = $_POST["facturation"];
        $CP = $_POST["postal"];
        $pays = $_POST["pays"];
        $ville = $_POST["ville"];
        $date = date("d-m-y");


        $sql = "INSERT INTO `info_facture` value (NULL,'$liv_adress','$fac_adress','$ville',$CP," . $PANIER_INFO['ID_user'] . ",'$date',$CB)";
        $result = $conn->query($sql);
        header("location:facture.php");
    }
    ?>
    <div class="contenu">
        <form method="POST" action='buy.php' onsubmit="return check_cb();">
            <div>
                <div>
                    <input type="text" placeholder="adresse de livraison" name="livraison">
                </div>
                <div>
                    <input type="text" placeholder="adresse de facturation" name="facturation">
                </div>
                <div>
                    <input type="text" placeholder="ville" name="ville">
                </div>
                <div>
                    <input type="text" placeholder="code postal" name="postal">
                </div>
                <div>
                    <input type="text" placeholder="pays" name="pays">
                </div>
                <div>
                    <input type="text" placeholder="carte bancaire" name="CB" onblur="check_cb()">
                </div>
                <div>
                    <input type="submit" name="envoyer" value="Confirmer le paiement" id="send">
                </div>
            </div>
        </form>
    </div>

    <?php
    require_once("footer.php");
    ?>
</body>

<script type="text/javascript" src="js/cb_checker.js?v=<?= ver() ?>"></script>
</html>
