<?php
require_once("db.php");
require_once("login/user_info.php");
require_once("mail.php");
require_once("login/common.php");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Connexion</title>
    <meta charset="utf8" />
    <link rel="stylesheet" href="CSS/connexion.css?v=<?= ver() ?>">
    <link rel="stylesheet" href="CSS/mail.css?v=<?= ver() ?>">
    <link rel="icon" type="image/png" href="Image/HeadLogo.png">
</head>

<body class="back">
    <?php
    $STATUS = 1;
    if (isset($_GET['code']) && !empty($_GET['code'])) {
        $get_code = htmlspecialchars($_GET['code']);
        if (count($_POST) > 0) {
            $pwd1 = $_POST['mdp1'];
            $pwd2 = $_POST['mdp2'];


            if ($pwd1 == $pwd2) {
                $lepass = password_hash($pwd1, PASSWORD_DEFAULT);
                $sql = "SELECT * FROM verif WHERE Code = '$get_code' ";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result);
                $id = $row['Users'];
                $update_sql = "UPDATE `utilisateur` SET `utilisateur`.`MotDePasse` = '$lepass' WHERE `utilisateur`.`ID` = '$id' ";
                $update_res = mysqli_query($conn, $update_sql);
                if ($update_res == true) {
                    $STATUS = 0;
                } else {
                    $_SESSION["ERROR"] = "Les modifications ont échoué réessayer ultérieurement.";
                }
            } else {
                $_SESSION["ERROR"] = "les mots de passe ne sont pas identique.";
            }
        }
    }
    ?>
    <div class="register">
        <?php if ($STATUS == 0) {
        ?>
            <div class="mailmessage"> Le mot de passe a été changé avec succès.</div>
        <?php } ?>
        <form action="modifpwd.php?code=<?= $get_code ?>" method="POST" onsubmit="return checker2()">
            <div>
                <h1>Changer de mot de passe</h1><a href="login/connexion.php" class="cross2"><img src="Image/checkmark.png" alt="cross" class="cross"></a>
                <br>

                <div>
                    <?php if (isset($_SESSION['ERROR'])) {
                    ?>
                        <div class="errormsg"><?= $_SESSION["ERROR"] ?></div>
                    <?php
                        unset($_SESSION["ERROR"]);
                    }
                    ?>

                </div>
            </div>
            <hr>
            <h3 class="msgSaisi">Saisissez votre nouveaux mot de passe.</h3>
            <div class="e-mail">
                <input type="text" placeholder="Nouveau mot de passe" name="mdp1">
            </div>
            <div class="e-mail">
                <input type="text" placeholder="confirmez le mot de passe" name="mdp2">
            </div>
            <hr>
            <div class="connexion"><input type="submit" value="Continuer"></div>
        </form>
    </div>
</body>
<script type="text/javascript" src="../js/inscription.js?v=<?= ver() ?>"></script>

</html>