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
    <link rel="stylesheet" type="text/css" href="CSS/card.css?v=<?= ver() ?>" />
    <link rel="icon" type="image/png" href="Image/HeadLogo.png" />

    <link rel="stylesheet" href="CSS/inscription.css?v=<?= ver() ?>">
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
        <form method="POST" action='buy.php' onsubmit="return check_cb();" id="Payment_form">
            <div class="register">
                <div>
                    <h1>Payement</h1>
                    <br>
                    <?php if (isset($_SESSION['ERROR'])) {
                    ?>
                        <div> <?= $_SESSION["ERROR"] ?></div>
                    <?php
                        unset($_SESSION["ERROR"]);
                    }
                    ?>
                </div>
                <hr class="hr1">
                <form action="inscription.php" method="POST" onsubmit="return checker()">

                    <span class="title-info"> &nbsp;Adresse de livraison :</span>
                    <div class="Pwd">
                        <input placeholder="Confirmer le mot de passe" type="text" name="pwd2" onblur="check_pwd2();" />
                        <span class="Error-Message" id="pwderror">les mots de passe ne correspondent pas</span>
                    </div>
                    <span class="title-info"> &nbsp;Ville :</span>
                    <div class="Pwd">
                        <input placeholder="Confirmer le mot de passe" type="text" name="pwd2" onblur="check_pwd2();" />
                        <span class="Error-Message" id="pwderror">les mots de passe ne correspondent pas</span>
                    </div>
                    <span class="title-info"> &nbsp;Code Postal :</span>
                    <div class="Pwd">
                        <input placeholder="Confirmer le mot de passe" type="text" name="pwd2" maxlength="5" onblur="check_pwd2();" />
                        <span class="Error-Message" id="pwderror">les mots de passe ne correspondent pas</span>
                    </div>
                    <hr>
                    <span class="title-info"> &nbsp;Numero de la carte :</span>
                    <div class="Pwd">
                        <input placeholder="Confirmer le mot de passe" type="text" name="pwd2" maxlength="16" onblur="check_pwd2();" />
                        <span class="Error-Message" id="pwderror">les mots de passe ne correspondent pas</span>
                    </div>
                    <span class="title-info"> &nbsp;Nom de la carte :</span>
                    <div class="Pwd">
                        <input placeholder="Confirmer le mot de passe" type="text" name="pwd2" onblur="check_pwd2();" />
                        <span class="Error-Message" id="pwderror">les mots de passe ne correspondent pas</span>
                    </div>
                    <span class="title-info"> &nbsp;Date d'expiration :</span>
                    <div class="Pwd">
                        <input placeholder="Confirmer le mot de passe" type="text" name="pwd2" onblur="check_pwd2();" />
                        <span class="Error-Message" id="pwderror">les mots de passe ne correspondent pas</span>
                    </div>
                    <span class="title-info"> &nbsp;CCV :</span>
                    <div class="Pwd">
                        <input placeholder="Confirmer le mot de passe" type="text" name="pwd2" maxlength="3" onblur="check_pwd2();" />
                        <span class="Error-Message" id="pwderror">les mots de passe ne correspondent pas</span>
                    </div>

                    <hr>
                    <div class="listing">
                        <input type="submit" value="S'inscrire" class="listing">
                    </div>



                </form>
            </div>
    </div>

    <?php
    require_once("footer.php");
    ?>
</body>

<script type="text/javascript" src="js/cb_checker.js?v=<?= ver() ?>"></script>

</html>